<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Documento;
class DocumentoControllerApi extends Controller
{
    public function index()
    {
        try {
            $docs = Documento::all();
            return response()->json([
                "message" => "Documentos pegos com sucesso",
                "response" => $docs,
                "errors" => [],
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Erro ao pegar os documentos",
                "response" => [],
                "errors" => [$e->getMessage()],
            ]);
        }
    }

    public function show($id)
    {
        try {
            $documento = Documento::find($id);
            return response()->json([
                "message" => "Documento $id achado com sucesso",
                "response" => $documento,
                "errors" => [],
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Erro ao pegar os documentos",
                "response" => [],
                "errors" => [$e->getMessage()],
            ]);
        }
    }
}
