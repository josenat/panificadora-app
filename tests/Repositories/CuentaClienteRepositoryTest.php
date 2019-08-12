<?php namespace Tests\Repositories;

use App\Models\CuentaCliente;
use App\Repositories\CuentaClienteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CuentaClienteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CuentaClienteRepository
     */
    protected $cuentaClienteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cuentaClienteRepo = \App::make(CuentaClienteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cuenta_cliente()
    {
        $cuentaCliente = factory(CuentaCliente::class)->make()->toArray();

        $createdCuentaCliente = $this->cuentaClienteRepo->create($cuentaCliente);

        $createdCuentaCliente = $createdCuentaCliente->toArray();
        $this->assertArrayHasKey('id', $createdCuentaCliente);
        $this->assertNotNull($createdCuentaCliente['id'], 'Created CuentaCliente must have id specified');
        $this->assertNotNull(CuentaCliente::find($createdCuentaCliente['id']), 'CuentaCliente with given id must be in DB');
        $this->assertModelData($cuentaCliente, $createdCuentaCliente);
    }

    /**
     * @test read
     */
    public function test_read_cuenta_cliente()
    {
        $cuentaCliente = factory(CuentaCliente::class)->create();

        $dbCuentaCliente = $this->cuentaClienteRepo->find($cuentaCliente->id);

        $dbCuentaCliente = $dbCuentaCliente->toArray();
        $this->assertModelData($cuentaCliente->toArray(), $dbCuentaCliente);
    }

    /**
     * @test update
     */
    public function test_update_cuenta_cliente()
    {
        $cuentaCliente = factory(CuentaCliente::class)->create();
        $fakeCuentaCliente = factory(CuentaCliente::class)->make()->toArray();

        $updatedCuentaCliente = $this->cuentaClienteRepo->update($fakeCuentaCliente, $cuentaCliente->id);

        $this->assertModelData($fakeCuentaCliente, $updatedCuentaCliente->toArray());
        $dbCuentaCliente = $this->cuentaClienteRepo->find($cuentaCliente->id);
        $this->assertModelData($fakeCuentaCliente, $dbCuentaCliente->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cuenta_cliente()
    {
        $cuentaCliente = factory(CuentaCliente::class)->create();

        $resp = $this->cuentaClienteRepo->delete($cuentaCliente->id);

        $this->assertTrue($resp);
        $this->assertNull(CuentaCliente::find($cuentaCliente->id), 'CuentaCliente should not exist in DB');
    }
}
