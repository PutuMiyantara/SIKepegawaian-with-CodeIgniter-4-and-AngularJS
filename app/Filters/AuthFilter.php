<?php
//app/Filters/Auth.php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthFilter implements FilterInterface
{
    private static $paths = [
        'user/' => 3,
        'user/admin' => 3,

        'user/pegawai' => 1,
        'pegawai/detailMutasi/(:num)' => 1,
    ];
    public function before(RequestInterface $request)
    {
        $session = Services::session();
        $router = Services::router();
        $option = $router->getMatchedRouteOptions();
        if (isset($option['role'])) {
            if ($session->has('email')) {
                if (is_array($option['role'])) {
                    if (in_array($session->get('role'), $option['role'])) {
                        return true;
                    }
                } elseif ($session->get('role') == $option['role']) {
                    return true;
                }
            }
            if (isset($option['ajax']) && $option['ajax'] == true) {
                // return Response, error code 401
                return Services::response()->setStatusCode(401)->setJSON([
                    "message" => "Unauthorized."
                ]);
            }
            return redirect()->to($option['role'] == 3 ? '/login' : '/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response)
    {
    }
}