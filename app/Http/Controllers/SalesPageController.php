<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SalesPage;
use Illuminate\Support\Facades\Auth;

class SalesPageController extends Controller
{
    public function create(Request $request)
    {
        return view('create', [
            'input' => $request->all(),
            'style' => $request->style ?? 'default',
            'page_id'=> $request->id ?? null,
            'action' => '/generate',
            'method' => 'POST',
            'button' => 'Generate',
        ]);
    }

    public function store(Request $request)
    {
        $page_id = $request->id ?? 0;
        $request->validate([
            'product' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'audience' => 'nullable|string',
            'price' => 'nullable|string',
            'selling_point' => 'nullable|string',
        ]);

        $data = [
            'product' => $request->product,
            'description' => $request->description,
            'features' => $request->features,
            'audience' => $request->audience,
            'price' => $request->price,
            'selling_point' => $request->selling_point,
        ];

        $style = $request->style ?? 'default';

        $filtered = array_filter($data);

        $details = "";
        foreach ($filtered as $key => $value) {
            $details .= "$key: $value\n";
        }

        $prompt = "Anda adalah copywriter profesional.

        Buat sales page dalam format JSON berikut:

        {
            \"headline\": \"...\",
            \"subheadline\": \"...\",
            \"description\": \"...\",
            \"benefits\": [\"...\"],
            \"features\": [\"...\"],
            \"social_proof\": \"...\",
            \"price_display\": \"...\",
            \"cta\": \"...\"
        }

        Gunakan gaya bahasa:
        - persuasif
        - emosional
        - fokus konversi

        JANGAN output apapun selain JSON.

        Data produk:
        \n" . $details;

        $apiKey = env('OPENROUTER_API_KEY');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $apiKey,
            "HTTP-Referer" => "http://localhost",
            "X-Title" => "AI Sales Generator"
        ])->post("https://openrouter.ai/api/v1/chat/completions", [
            "model" => "openrouter/auto",
            "messages" => [
                [
                    "role" => "user",
                    "content" => $prompt
                ]
            ]
        ]);

        $resultText = $response->json()['choices'][0]['message']['content'] ?? '{}';

        $cleanJson = preg_replace('/```json|```/', '', $resultText);

        $result = json_decode($cleanJson, true);

        if (!$result) {
            $result = [
                "headline" => "Gagal generate",
                "subheadline" => "",
                "description" => $resultText,
                "benefits" => [],
                "features" => [],
                "social_proof" => "",
                "price_display" => "",
                "cta" => ""
            ];
        }

        return view('preview', [
            'result' => $result,
            'style' => $style,
            'input' => $data,
            'id'    => $page_id,
        ]);
    }

    public function save(Request $request)
    {
        $result = json_decode($request->result, true);
        $input = json_decode($request->input, true);

        if (!$result) {
            dd('JSON gagal parse', $request->result);
        }

        SalesPage::create([
            'user_id' => auth()->id() ?? 1,

            'title' => $input['product'] ?? ($result['headline'] ?? 'Untitled'),

            'headline' => $result['headline'] ?? null,
            'subheadline' => $result['subheadline'] ?? null,
            'description' => $result['description'] ?? null,

            'benefits' => $result['benefits'] ?? [],
            'features' => $result['features'] ?? [],

            'social_proof' => $result['social_proof'] ?? null,
            'price_display' => $result['price_display'] ?? null,
            'cta' => $result['cta'] ?? null,

            'style' => $request->style ?? 'default',
            'input_data' => $input
        ]);

        return redirect('/')->with('success', 'Berhasil disimpan!');
    }

    public function index()
    {
        $pages = SalesPage::where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view('home', compact('pages'));
    }

    public function show($id)
    {
        $page = SalesPage::findOrFail($id);

        $result = [
            'headline' => $page->headline,
            'subheadline' => $page->subheadline,
            'description' => $page->description,
            'benefits' => $page->benefits,
            'features' => $page->features,
            'social_proof' => $page->social_proof,
            'price_display' => $page->price_display,
            'cta' => $page->cta,
        ];

        $style = $page->style;

        return view('detail', [
            'result' => $result,
            'style' => $page->style,
            'id' => $page->id
        ]);
    }

    public function edit($id)
    {
        $page = SalesPage::findOrFail($id);
        //dd($page->input_data);

        return view('create', [
            'input' => $page->input_data,
            'style' => $page->style,
            'page_id'=> $id,
            'action' => '/generate',
            'method' => 'POST',
            'button' => 'Generate'
        ]);
    }

    public function update(Request $request, $id)
    {
        $result = json_decode($request->result, true);
        $input = json_decode($request->input, true);

        $page = SalesPage::findOrFail($id);

        //dd($input->style);

        $data = [
            'product' => $input['product'],
            'description' => $input['description'],
            'features' => $input['features'],
            'audience' => $input['audience'],
            'price' => $input['price'],
            'selling_point' => $input['selling_point'],
        ];

        $style = $request->style ?? 'default';

        $page->update([
            'title' => $data['product'] ?? $result['headline'],

            'headline' => $result['headline'] ?? null,
            'subheadline' => $result['subheadline'] ?? null,
            'description' => $result['description'] ?? null,

            'benefits' => $result['benefits'] ?? [],
            'features' => $result['features'] ?? [],

            'social_proof' => $result['social_proof'] ?? null,
            'price_display' => $result['price_display'] ?? null,
            'cta' => $result['cta'] ?? null,

            'style' => $style,
            'input_data' => $data
        ]);

        return redirect('/')->with('success', 'Berhasil diupdate!');
    }

    public function destroy($id)
    {
        $page = SalesPage::findOrFail($id);

        $page->delete();

        return redirect('/')->with('success', 'Data berhasil dihapus');
    }

    public function export($id)
    {
        $page = SalesPage::findOrFail($id);

        $result = [
            'headline' => $page->headline,
            'subheadline' => $page->subheadline,
            'description' => $page->description,
            'benefits' => $page->benefits,
            'features' => $page->features,
            'social_proof' => $page->social_proof,
            'price_display' => $page->price_display,
            'cta' => $page->cta,
        ];

        $style = $page->style;

        $html = view('export', [
            'result' => $result,
            'style' => $style,
            'export' => true
        ])->render();

        $words = explode(' ', $page->title);
        $firstTwoWords = implode(' ', array_slice($words, 0, 2));

        $filename = 'sales-page-' . \Str::slug($firstTwoWords) . '.html';

        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}