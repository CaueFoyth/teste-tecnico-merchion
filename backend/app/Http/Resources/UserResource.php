<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    /**
     * @OA\Schema(
     * title="UserResource",
     * description="Recurso do Usuário",
     * @OA\Property(
     * property="id",
     * type="integer",
     * description="ID do usuário",
     * example=1
     * ),
     * @OA\Property(
     * property="name",
     * type="string",
     * description="Nome do usuário",
     * example="Seu nome lindo"
     * ),
     * @OA\Property(
     * property="email",
     * type="string",
     * format="email",
     * description="Email do usuário",
     * example="seu_melhor_email@email.com"
     * ),
     * @OA\Property(
     * property="joined_at",
     * type="string",
     * description="Data de cadastro do usuário",
     * example="31/07/2025"
     * )
     * )
     */
    class UserResource extends JsonResource
    {
        public function toArray(Request $request): array
        {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'joined_at' => $this->created_at->format('d/m/Y'),
            ];
        }
    }