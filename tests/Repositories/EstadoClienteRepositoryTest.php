<?php namespace Tests\Repositories;

use App\Models\EstadoCliente;
use App\Repositories\EstadoClienteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EstadoClienteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EstadoClienteRepository
     */
    protected $estadoClienteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->estadoClienteRepo = \App::make(EstadoClienteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_estado_cliente()
    {
        $estadoCliente = factory(EstadoCliente::class)->make()->toArray();

        $createdEstadoCliente = $this->estadoClienteRepo->create($estadoCliente);

        $createdEstadoCliente = $createdEstadoCliente->toArray();
        $this->assertArrayHasKey('id', $createdEstadoCliente);
        $this->assertNotNull($createdEstadoCliente['id'], 'Created EstadoCliente must have id specified');
        $this->assertNotNull(EstadoCliente::find($createdEstadoCliente['id']), 'EstadoCliente with given id must be in DB');
        $this->assertModelData($estadoCliente, $createdEstadoCliente);
    }

    /**
     * @test read
     */
    public function test_read_estado_cliente()
    {
        $estadoCliente = factory(EstadoCliente::class)->create();

        $dbEstadoCliente = $this->estadoClienteRepo->find($estadoCliente->id);

        $dbEstadoCliente = $dbEstadoCliente->toArray();
        $this->assertModelData($estadoCliente->toArray(), $dbEstadoCliente);
    }

    /**
     * @test update
     */
    public function test_update_estado_cliente()
    {
        $estadoCliente = factory(EstadoCliente::class)->create();
        $fakeEstadoCliente = factory(EstadoCliente::class)->make()->toArray();

        $updatedEstadoCliente = $this->estadoClienteRepo->update($fakeEstadoCliente, $estadoCliente->id);

        $this->assertModelData($fakeEstadoCliente, $updatedEstadoCliente->toArray());
        $dbEstadoCliente = $this->estadoClienteRepo->find($estadoCliente->id);
        $this->assertModelData($fakeEstadoCliente, $dbEstadoCliente->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_estado_cliente()
    {
        $estadoCliente = factory(EstadoCliente::class)->create();

        $resp = $this->estadoClienteRepo->delete($estadoCliente->id);

        $this->assertTrue($resp);
        $this->assertNull(EstadoCliente::find($estadoCliente->id), 'EstadoCliente should not exist in DB');
    }
}
