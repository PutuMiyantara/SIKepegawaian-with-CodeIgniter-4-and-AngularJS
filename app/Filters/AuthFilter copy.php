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
        $uri = $request->uri->getPath();
        $session = session();
        foreach (static::$paths as $path => $role) {
            $path = str_ireplace(':num', '[0-9]+', $path);
            $path = str_replace('/', '\/', trim($path, '/ '));
            $path = strtolower(str_replace('*', '.*', $path));
            if (preg_match('#^' . $path . '$#', $uri, $match) === 1) {
                $userrole = is_array($role) ? $role['role'] : $role;
                if ($session->has('email')) {
                    if ($session->get('role') == $userrole) {
                        return true;
                    }
                }

                if (is_array($role) && $role['ajax']) {
                    // return Response, error code 401
                    return redirect(base_url('/'));
                }

                return redirect()->to($userrole == 3 ? '/login' : '/login');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response)
    {
    }
}

// $session = Services::session();
// // var_dump($request->uri->getPath());
// // die;
// if ($session->has('email')) {
//     if ($request->uri->getPath() == 'login') {
//         if ($session->get('role') == 3) {
//             return redirect()->to(base_url('/user/admin'));
//         } else if ($session->get('role') == 2) {
//             return redirect()->to(base_url('/user/pegawai'));
//         } else if ($session->get('role') == 1) {
//             return redirect()->to(base_url('/user/pegawai'));
//         }
//     }
// } else {
//     if ($request->uri->getPath() != 'login') {
//         return redirect()->to(base_url('/login'));
//     }
// }