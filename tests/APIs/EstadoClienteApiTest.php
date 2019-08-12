<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\EstadoCliente;

class EstadoClienteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_estado_cliente()
    {
        $estadoCliente = factory(EstadoCliente::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/estado_clientes', $estadoCliente
        );

        $this->assertApiResponse($estadoCliente);
    }

    /**
     * @test
     */
    public function test_read_estado_cliente()
    {
        $estadoCliente = factory(EstadoCliente::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/estado_clientes/'.$estadoCliente->id
        );

        $this->assertApiResponse($estadoCliente->toArray());
    }

    /**
     * @test
     */
    public function test_update_estado_cliente()
    {
        $estadoCliente = factory(EstadoCliente::class)->create();
        $editedEstadoCliente = factory(EstadoCliente::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/estado_clientes/'.$estadoCliente->id,
            $editedEstadoCliente
        );

        $this->assertApiResponse($editedEstadoCliente);
    }

    /**
     * @test
     */
    public function test_delete_estado_cliente()
    {
        $estadoCliente = factory(EstadoCliente::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/estado_clientes/'.$estadoCliente->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/estado_clientes/'.$estadoCliente->id
        );

        $this->response->assertStatus(404);
    }
}
