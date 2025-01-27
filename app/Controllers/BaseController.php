<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\MiembrosModel;
use App\Models\MembresiasModel;
use App\Models\PaquetesModel;
use App\Models\AsistenciaModel;
use App\Models\UsuarioModel;
use App\Models\AsistenciaInstructorModel;
use App\Models\MovimientoModel;
use App\Models\RolModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $CI_VERSION = \CodeIgniter\CodeIgniter::CI_VERSION;
    public $session = null;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['operaciones', 'form', 'html'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->db = \Config\Database::connect();

        // Preload any models, libraries, etc, here.
        $this->miembrosModel = new MiembrosModel($this->db);
        $this->membresiasModel = new MembresiasModel($this->db);
        $this->paquetesModel = new PaquetesModel($this->db);
        $this->asistenciaModel = new AsistenciaModel($this->db);
        $this->usuarioModel = new UsuarioModel($this->db);
        $this->asistenciaInstructorModel = new AsistenciaInstructorModel($this->db); 
        $this->movimientoModel = new MovimientoModel($this->db);   
        $this->rolModel = new RolModel($this->db); 

        // E.g.: $this->session = \Config\Services::session();
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->image = \Config\Services::image();
        $this->version = '1.0.4';
    }
}
