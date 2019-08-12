<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CuentaCliente;

class CuentaClienteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cuenta_cliente()
    {
        $cuentaCliente = factory(CuentaCliente::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cuenta_clientes', $cuentaCliente
        );

        $this->assertApiResponse($cuentaCliente);
    }

    /**
     * @test
     */
    public function test_read_cuenta_cliente()
    {
        $cuentaCliente = factory(CuentaCliente::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/cuenta_clientes/'.$cuentaCliente->id
        );

        $this->assertApiResponse($cuentaCliente->toArray());
    }

    /**
     * @test
     */
    public function test_update_cuenta_cliente()
    {
        $cuentaCliente = factory(CuentaCliente::class)->create();
        $editedCuentaCliente = factory(CuentaCliente::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cuenta_clientes/'.$cuentaCliente->id,
            $editedCuentaCliente
        );

        $this->assertApiResponse($editedCuentaCliente);
    }

    /**
     * @test
     */
    public function test_delete_cuenta_cliente()
    {
        $cuentaCliente = factory(CuentaCliente::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cuenta_clientes/'.$cuentaCliente->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cuenta_clientes/'.$cuentaCliente->id
        );

        $this->response->assertStatus(404);
    }
}
