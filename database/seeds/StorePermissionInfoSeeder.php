<?php

use App\Category;
use App\MainCategory;
use Illuminate\Database\Seeder;
use App\User;
use App\StorePermission\Models\Role;
use App\StorePermission\Models\Permission;
use App\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StorePermissionInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        //truncate tables
        DB::statement('SET foreing_key_checks=0');
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        Permission::truncate();
        Role::truncate();
        DB::statement('SET foreing_key_checks=1');*/

        //user admin
        $useradmin = User::where('email', 'admin@admin.com')->first();
        if (!$useradmin) {
            $useradmin = User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);
        };

        //rol admin
        $roladmin = Role::where('slug', 'admin')->first();
        if (!$roladmin) {
            $roladmin = Role::create([
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrador',
                'full-access' => 'yes',
            ]);
        }

        //rol Registered User
        $roluser = Role::where('slug', 'registereduser')->first();
        if (!$roluser) {
            $roluser = Role::create([
                'name' => 'Registered User',
                'slug' => 'registereduser',
                'description' => 'Registered User',
                'full-access' => 'no',
            ]);
        }

        //rol Registered Seller
        $roluser = Role::where('slug', 'registeredseller')->first();
        if (!$roluser) {
            $roluser = Role::create([
                'name' => 'Registered Seller',
                'slug' => 'registeredseller',
                'description' => 'Registered Seller',
                'full-access' => 'no',
            ]);
        }

        //tabla role user
        $useradmin->roles()->sync([$roladmin->id]);

        //permission
        $permission_all = [];

        //permission role
        $permission = Permission::where('slug', 'role.index')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'List Role',
                'slug' => 'role.index',
                'description' => 'A user can list role',
            ]);
        }

        $permission_all[] = $permission->id;


        //permission show role
        $permission = Permission::where('slug', 'role.show')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Show Role',
                'slug' => 'role.show',
                'description' => 'A user can see a role',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission create role
        $permission = Permission::where('slug', 'role.create')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Create Role',
                'slug' => 'role.create',
                'description' => 'A user can create a role',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission edit role
        $permission = Permission::where('slug', 'role.edit')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Edit Role',
                'slug' => 'role.edit',
                'description' => 'A user can edit a role',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission destroy role
        $permission = Permission::where('slug', 'role.destroy')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Destroy Role',
                'slug' => 'role.destroy',
                'description' => 'A user can destroy a role',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission user
        $permission = Permission::where('slug', 'user.index')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'List User',
                'slug' => 'user.index',
                'description' => 'A user can list user',
            ]);
        }

        $permission_all[] = $permission->id;


        //permission show user
        $permission = Permission::where('slug', 'user.show')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Show User',
                'slug' => 'user.show',
                'description' => 'A user can see a user',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission create user
        $permission = Permission::where('slug', 'user.create')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Create User',
                'slug' => 'user.create',
                'description' => 'A user can create a user',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission edit user
        $permission = Permission::where('slug', 'user.edit')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Edit User',
                'slug' => 'user.edit',
                'description' => 'A user can edit a user',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission destroy user
        $permission = Permission::where('slug', 'user.destroy')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Destroy User',
                'slug' => 'user.destroy',
                'description' => 'A user can destroy a user',
            ]);
        }

        $permission_all[] = $permission->id;


        //new
        $permission = Permission::where('slug', 'userown.show')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Show Own User',
                'slug' => 'userown.show',
                'description' => 'A user can see his own user',
            ]);
        }

        $permission_all[] = $permission->id;

        $permission = Permission::where('slug', 'userown.edit')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Edit Own User',
                'slug' => 'userown.edit',
                'description' => 'A user can edit his own user',
            ]);
        }

        $permission_all[] = $permission->id;


        //tabla permission rol
        //$roladmin->permissions()->sync($permission_all);


        //                     Category Permission
        //permission category
        $permission = Permission::where('slug', 'category.index')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'List Category',
                'slug' => 'category.index',
                'description' => 'A user can list category',
            ]);
        }

        $permission_all[] = $permission->id;


        //permission show category
        $permission = Permission::where('slug', 'category.show')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Show Category',
                'slug' => 'category.show',
                'description' => 'A user can see a category',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission create category
        $permission = Permission::where('slug', 'category.create')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Create Category',
                'slug' => 'category.create',
                'description' => 'A user can create a category',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission edit category
        $permission = Permission::where('slug', 'category.edit')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Edit Category',
                'slug' => 'category.edit',
                'description' => 'A user can edit a category',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission destroy category
        $permission = Permission::where('slug', 'category.destroy')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Destroy Category',
                'slug' => 'category.destroy',
                'description' => 'A user can destroy a category',
            ]);
        }

        $permission_all[] = $permission->id;


        //                     Product Permission
        //permission product
        $permission = Permission::where('slug', 'product.index')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'List Product',
                'slug' => 'product.index',
                'description' => 'A user can list product',
            ]);
        }

        $permission_all[] = $permission->id;


        //permission show product
        $permission = Permission::where('slug', 'product.show')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Show Product',
                'slug' => 'product.show',
                'description' => 'A user can see a product',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission create product
        $permission = Permission::where('slug', 'product.create')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Create Product',
                'slug' => 'product.create',
                'description' => 'A user can create a product',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission edit product
        $permission = Permission::where('slug', 'product.edit')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Edit Product',
                'slug' => 'product.edit',
                'description' => 'A user can edit a product',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission destroy product
        $permission = Permission::where('slug', 'product.destroy')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Destroy Product',
                'slug' => 'product.destroy',
                'description' => 'A user can destroy a product',
            ]);
        }

        $permission_all[] = $permission->id;

        //permission list comment
        $permission = Permission::where('slug', 'store.full')->first();
        if (!$permission) {
            $permission = Permission::create([
                'name' => 'Store Permision',
                'slug' => 'store.full',
                'description' => 'A user can see all of the store',
            ]);
        }

        $permission_all[] = $permission->id;

        




//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------



        //Categories
        $categoria = Category::where('slug', 'ropa-zapatos-y-joyas')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Ropa, Zapatos y Joyas',
                'slug' => 'ropa-zapatos-y-joyas',
                'descripcion' => 'Categoría de Ropa, Zapatos y Joyas',
            ]);
        };

        $categoria = Category::where('slug', 'libros')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Libros',
                'slug' => 'libros',
                'descripcion' => 'Categoría de Libros',
            ]);
        };

        $categoria = Category::where('slug', 'peliculas-musica-y-juegos')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Películas, Música y Juegos',
                'slug' => 'peliculas-musica-y-juegos',
                'descripcion' => 'Categoría de Películas, Música y Juegos',
            ]);
        };

        $categoria = Category::where('slug', 'electronicos')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Electrónicos',
                'slug' => 'electronicos',
                'descripcion' => 'Categoría de Aparatos Electrónicos',
            ]);
        };

        $categoria = Category::where('slug', 'computadoras')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Computadoras',
                'slug' => 'computadoras',
                'descripcion' => 'Categoría de Computadoras',
            ]);
        };

        $categoria = Category::where('slug', 'computadoras')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Computadoras',
                'slug' => 'computadoras',
                'descripcion' => 'Categoría de Computadoras',
            ]);
        };

        $categoria = Category::where('slug', 'automotriz')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Automotriz',
                'slug' => 'automotriz',
                'descripcion' => 'Categoría de Automotriz',
            ]);
        };

        $categoria = Category::where('slug', 'alimentos-y-bebidas')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Alimentos y Bebidas',
                'slug' => 'alimentos-y-bebidas',
                'descripcion' => 'Categoría de Alimentos y Bebidas',
            ]);
        };

        $categoria = Category::where('slug', 'belleza-y-cuidado-personal')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Belleza y Cuidado Personal',
                'slug' => 'belleza-y-cuidado-personal',
                'descripcion' => 'Categoría de Belleza y Cuidado Personal',
            ]);
        };


        //Sub Categories

        //--------------------Ropa, Zapatos y Joyas-------------------------------
        $categoria = SubCategory::where('slug', 'hombres')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '1',
                'nombre' => 'Hombres',
                'slug' => 'hombres',
                'descripcion' => 'Categoría de Hombres',
            ]);
        };

        $categoria = SubCategory::where('slug', 'mujeres')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '1',
                'nombre' => 'Mujeres',
                'slug' => 'mujeres',
                'descripcion' => 'Categoría de Mujeres',
            ]);
        };

        $categoria = SubCategory::where('slug', 'ninos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '1',
                'nombre' => 'Niños',
                'slug' => 'ninos',
                'descripcion' => 'Categoría de Niños',
            ]);
        };

        $categoria = SubCategory::where('slug', 'ninas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '1',
                'nombre' => 'Niñas',
                'slug' => 'ninas',
                'descripcion' => 'Categoría de Niñas',
            ]);
        };

        $categoria = SubCategory::where('slug', 'bebes')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '1',
                'nombre' => 'Bebés',
                'slug' => 'bebes',
                'descripcion' => 'Categoría de Bebés',
            ]);
        };


        //--------------------LIBROS-------------------------------
        $categoria = SubCategory::where('slug', 'libros')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '2',
                'nombre' => 'Libros',
                'slug' => 'libros',
                'descripcion' => 'Categoría de Libros',
            ]);
        };


        //--------------------Películas, Música y Juegos-------------------------------
        $categoria = SubCategory::where('slug', 'cine-y-tv')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '3',
                'nombre' => 'Cine y TV',
                'slug' => 'cine-y-tv',
                'descripcion' => 'Categoría de Cine y TV',
            ]);
        };

        $categoria = SubCategory::where('slug', 'instrumentos-musicales')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '3',
                'nombre' => 'Instrumentos Musicales',
                'slug' => 'instrumentos-musicales',
                'descripcion' => 'Categoría de Instrumentos Musicales',
            ]);
        };

        $categoria = SubCategory::where('slug', 'musica')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '3',
                'nombre' => 'Música',
                'slug' => 'musica',
                'descripcion' => 'Categoría de Música',
            ]);
        };

        $categoria = SubCategory::where('slug', 'videojuegos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '3',
                'nombre' => 'Videojuegos',
                'slug' => 'videojuegos',
                'descripcion' => 'Categoría de Videojuegos',
            ]);
        };


        //--------------------ELECTRONICOS-------------------------------
        $categoria = SubCategory::where('slug', 'accesorios-y-suministros')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Accesorios y Suministros',
                'slug' => 'accesorios-y-suministros',
                'descripcion' => 'Categoría de Accesorios y Suministros',
            ]);
        };

        $categoria = SubCategory::where('slug', 'audifonos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Audífonos',
                'slug' => 'audifonos',
                'descripcion' => 'Categoría de Audífonos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'audio-para-el-hogar')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Audio para el Hogar',
                'slug' => 'audio-para-el-hogar',
                'descripcion' => 'Categoría de Audio para el Hogar',
            ]);
        };

        $categoria = SubCategory::where('slug', 'camaras-y-fotografia')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Cámaras y Fotografía',
                'slug' => 'camaras-y-fotografia',
                'descripcion' => 'Categoría de Cámaras y Fotografía',
            ]);
        };

        $categoria = SubCategory::where('slug', 'consolas-y-accesorios-para-videojuegos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Consolas y Accesorios para Videojuegos',
                'slug' => 'consolas-y-accesorios-para-videojuegos',
                'descripcion' => 'Categoría de Consolas y Accesorios para Videojuegos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'electronica-para-autos-y-vehiculos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Electrónica para Autos y Vehículos',
                'slug' => 'electronica-para-autos-y-vehiculos',
                'descripcion' => 'Categoría de Electrónica para Autos y Vehículos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'electronicos-de-oficina')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Electrónicos de Oficina',
                'slug' => 'electronicos-de-oficina',
                'descripcion' => 'Categoría de Electrónicos de Oficina',
            ]);
        };

        $categoria = SubCategory::where('slug', 'navegacion-satelital-y-gps')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Navegación Satelital y GPS',
                'slug' => 'navegacion-satelital-y-gps',
                'descripcion' => 'Categoría de Navegación Satelital y GPS',
            ]);
        };

        $categoria = SubCategory::where('slug', 'tecnologia-vestible')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Tecnología Vestible',
                'slug' => 'tecnologia-vestible',
                'descripcion' => 'Categoría de Tecnología Vestible',
            ]);
        };

        $categoria = SubCategory::where('slug', 'telefonos-celulares-y-accesorios')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Teléfonos Celulares y Accesorios',
                'slug' => 'telefonos-celulares-y-accesorios',
                'descripcion' => 'Categoría de Teléfonos Celulares y Accesorios',
            ]);
        };

        $categoria = SubCategory::where('slug', 'television-y-video')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Televisión y Vídeo',
                'slug' => 'television-y-video',
                'descripcion' => 'Categoría de Televisión y Vídeo',
            ]);
        };


        $categoria = SubCategory::where('slug', 'tecnologia-vestible')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Tecnología Vestible',
                'slug' => 'tecnologia-vestible',
                'descripcion' => 'Categoría de Tecnología Vestible',
            ]);
        };

        $categoria = SubCategory::where('slug', 'seguridad-y-vigilancia')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Seguridad y Vigilancia',
                'slug' => 'seguridad-y-vigilancia',
                'descripcion' => 'Categoría de Seguridad y Vigilancia',
            ]);
        };


        //--------------------COMPUTADORAS-------------------------------
        $categoria = SubCategory::where('slug', 'accesorios-para-computadora')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Accesorios para Computadora',
                'slug' => 'accesorios-para-computadora',
                'descripcion' => 'Categoría de Accesorios para Computadora',
            ]);
        };

        $categoria = SubCategory::where('slug', 'accesorios-para-tablets')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Accesorios para Tablets',
                'slug' => 'accesorios-para-tablets',
                'descripcion' => 'Categoría de Accesorios para Tablets',
            ]);
        };

        $categoria = SubCategory::where('slug', 'almacenamiento-externo-de-datos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Almacenamiento Externo de Datos',
                'slug' => 'almacenamiento-externo-de-datos',
                'descripcion' => 'Categoría de Almacenamiento Externo de Datos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'componentes-de-computadoras')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Componentes de Computadoras',
                'slug' => 'componentes-de-computadoras',
                'descripcion' => 'Categoría de Componentes de Computadoras',
            ]);
        };

        $categoria = SubCategory::where('slug', 'computadoras-y-tablets')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Computadoras y Tablets',
                'slug' => 'computadoras-y-tablets',
                'descripcion' => 'Categoría de Computadoras y Tablets',
            ]);
        };

        $categoria = SubCategory::where('slug', 'escaneres')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Escáneres',
                'slug' => 'escaneres',
                'descripcion' => 'Categoría de Escáneres',
            ]);
        };

        $categoria = SubCategory::where('slug', 'impresoras')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Impresoras',
                'slug' => 'impresoras',
                'descripcion' => 'Categoría de Impresoras',
            ]);
        };

        $categoria = SubCategory::where('slug', 'monitores')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Monitores',
                'slug' => 'monitores',
                'descripcion' => 'Categoría de Monitores',
            ]);
        };


        //--------------------AUTOMOTRIZ-------------------------------
        $categoria = SubCategory::where('slug', 'accesorios-exteriores')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Accesorios Exteriores',
                'slug' => 'accesorios-exteriores',
                'descripcion' => 'Categoría de Accesorios Exteriores',
            ]);
        };

        $categoria = SubCategory::where('slug', 'accesorios-interiores')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Accesorios Interiores',
                'slug' => 'accesorios-interiores',
                'descripcion' => 'Categoría de Accesorios Interiores',
            ]);
        };

        $categoria = SubCategory::where('slug', 'aceites-y-fluidos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Aceites y Fluidos',
                'slug' => 'aceites-y-fluidos',
                'descripcion' => 'Categoría de Aceites y Fluidos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-automotriz')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Cuidado Automotriz',
                'slug' => 'cuidado-automotriz',
                'descripcion' => 'Categoría de Cuidado Automotriz',
            ]);
        };

        $categoria = SubCategory::where('slug', 'herramientas-y-equipos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Herramientas y Equipos',
                'slug' => 'herramientas-y-equipos',
                'descripcion' => 'Categoría de Herramientas y Equipos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'luces-y-accesorios-de-iluminacion')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Luces y Accesorios de Iluminación',
                'slug' => 'luces-y-accesorios-de-iluminacion',
                'descripcion' => 'Categoría de Luces y Accesorios de Iluminación',
            ]);
        };

        $categoria = SubCategory::where('slug', 'motos-accesorios-y-piezas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Motos, Accesorios y Piezas',
                'slug' => 'motos-accesorios-y-piezas',
                'descripcion' => 'Categoría de Motos, Accesorios y Piezas',
            ]);
        };

        $categoria = SubCategory::where('slug', 'neumaticos-y-ruedas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Neumáticos y Ruedas',
                'slug' => 'neumaticos-y-ruedas',
                'descripcion' => 'Categoría de Neumáticos y Ruedas',
            ]);
        };

        $categoria = SubCategory::where('slug', 'pintura-y-suministros-de-pintura')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Pintura y Suministros de Pintura',
                'slug' => 'pintura-y-suministros-de-pintura',
                'descripcion' => 'Categoría de Pintura y Suministros de Pintura',
            ]);
        };

        $categoria = SubCategory::where('slug', 'repuestos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Repuestos',
                'slug' => 'repuestos',
                'descripcion' => 'Categoría de Repuestos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'sonido')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Sonido',
                'slug' => 'sonido',
                'descripcion' => 'Categoría de Sonido',
            ]);
        };


        //--------------------Alimentos y Bebidas-------------------------------
        $categoria = SubCategory::where('slug', 'bebidas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '7',
                'nombre' => 'Bebidas',
                'slug' => 'bebidas',
                'descripcion' => 'Categoría de Bebidas',
            ]);
        };

        $categoria = SubCategory::where('slug', 'comestibles')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '7',
                'nombre' => 'Comestibles',
                'slug' => 'comestibles',
                'descripcion' => 'Categoría de Comestibles',
            ]);
        };

        $categoria = SubCategory::where('slug', 'comida-preparada')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '7',
                'nombre' => 'Comida Preparada',
                'slug' => 'comida-preparada',
                'descripcion' => 'Categoría de Comida Preparada',
            ]);
        };
        

        //--------------------Belleza y Cuidado Personal-------------------------------
        $categoria = SubCategory::where('slug', 'articulos-y-accesorios')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Artículos y Accesorios',
                'slug' => 'articulos-y-accesorios',
                'descripcion' => 'Categoría de Artículos y Accesorios',
            ]);
        };

        $categoria = SubCategory::where('slug', 'afeitado-y-depilacion')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Afeitado y Depilación',
                'slug' => 'afeitado-y-depilacion',
                'descripcion' => 'Categoría de Afeitado y Depilación',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cosmeticos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cosméticos',
                'slug' => 'cosmeticos',
                'descripcion' => 'Categoría de Cosméticos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-bucal')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado Bucal',
                'slug' => 'cuidado-bucal',
                'descripcion' => 'Categoría de Cuidado Bucal',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-personal')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado Personal',
                'slug' => 'cuidado-personal',
                'descripcion' => 'Categoría de Cuidado Personal',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-del-cabello')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado del Cabello',
                'slug' => 'cuidado-del-cabello',
                'descripcion' => 'Categoría de Cuidado del Cabello',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-de-la-piel')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado de la Piel',
                'slug' => 'cuidado-de-la-piel',
                'descripcion' => 'Categoría de Cuidado de la Piel',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-de-pies-manos-y-unas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado de Pies, Manos y Uñas',
                'slug' => 'cuidado-de-pies-manos-y-unas',
                'descripcion' => 'Categoría de Cuidado de Pies, Manos y Uñas',
            ]);
        };

        $categoria = SubCategory::where('slug', 'fragancia')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Fragancia',
                'slug' => 'fragancia',
                'descripcion' => 'Categoría de Fragancia',
            ]);
        };




//-------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------


        //Main Categories

        //--------------------Ropa, Zapatos y Joyas-------------------------------
        //--------------------Hombres-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-hombre')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '1',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-hombre',
                'descripcion' => 'Categoría de Accesorios de Hombre',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calzado-hombre')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '1',
                'nombre' => 'Calzado',
                'slug' => 'calzado-hombre',
                'descripcion' => 'Categoría de Calzado de Hombre',
            ]);
        };

        $categoria = MainCategory::where('slug', 'relojes-hombre')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '1',
                'nombre' => 'Relojes',
                'slug' => 'relojes-hombre',
                'descripcion' => 'Categoría de Relojes de Hombre',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-hombre')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '1',
                'nombre' => 'Ropa',
                'slug' => 'ropa-hombre',
                'descripcion' => 'Categoría de Ropa de Hombre',
            ]);
        };


        //--------------------Mujeres-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-mujer',
                'descripcion' => 'Categoría de Accesorios de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bolsos-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Bolsos',
                'slug' => 'bolsos-mujer',
                'descripcion' => 'Categoría de Bolsos de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calzado-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Calzado',
                'slug' => 'calzado-mujer',
                'descripcion' => 'Categoría de Calzado de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'joyeria-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Joyería',
                'slug' => 'joyeria-mujer',
                'descripcion' => 'Categoría de Joyería de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'relojes-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Relojes',
                'slug' => 'relojes-mujer',
                'descripcion' => 'Categoría de Relojes de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Ropa',
                'slug' => 'ropa-mujer',
                'descripcion' => 'Categoría de Ropa de Mujer',
            ]);
        };


        //--------------------Niños-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-nino')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '3',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-nino',
                'descripcion' => 'Categoría de Accesorios de Niño',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calzado-nino')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '3',
                'nombre' => 'Calzado',
                'slug' => 'calzado-nino',
                'descripcion' => 'Categoría de Calzado de Niño',
            ]);
        };

        $categoria = MainCategory::where('slug', 'relojes-nino')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '3',
                'nombre' => 'Relojes',
                'slug' => 'relojes-nino',
                'descripcion' => 'Categoría de Relojes de Niño',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-nino')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '3',
                'nombre' => 'Ropa',
                'slug' => 'ropa-nino',
                'descripcion' => 'Categoría de Ropa de Niño',
            ]);
        };


        //--------------------Niñas-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-nina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '4',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-nina',
                'descripcion' => 'Categoría de Accesorios de Niña',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calzado-nina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '4',
                'nombre' => 'Calzado',
                'slug' => 'calzado-nina',
                'descripcion' => 'Categoría de Calzado de Niña',
            ]);
        };

        $categoria = MainCategory::where('slug', 'relojes-nina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '4',
                'nombre' => 'Relojes',
                'slug' => 'relojes-nina',
                'descripcion' => 'Categoría de Relojes de Niña',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-nina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '4',
                'nombre' => 'Ropa',
                'slug' => 'ropa-nina',
                'descripcion' => 'Categoría de Ropa de Niña',
            ]);
        };

        //--------------------Bebes-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-bebe',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'actividad-y-entretenimiento-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Actividad y Entretenimiento',
                'slug' => 'actividad-y-entretenimiento-bebe',
                'descripcion' => 'Categoría de Actividad y Entretenimiento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'alimentacion-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Alimentación',
                'slug' => 'alimentacion-bebe',
                'descripcion' => 'Categoría de Alimentación',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-de-bebes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Cuidado de Bebés',
                'slug' => 'cuidado-de-bebes',
                'descripcion' => 'Categoría de Cuidado de Bebés',
            ]);
        };

        $categoria = MainCategory::where('slug', 'embarazo-y-maternidad')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Embarazo y Maternidad',
                'slug' => 'embarazo-y-maternidad',
                'descripcion' => 'Categoría de Embarazo y Maternidad',
            ]);
        };

        $categoria = MainCategory::where('slug', 'habitacion-de-bebes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Habitación de Bebés',
                'slug' => 'habitacion-de-bebes',
                'descripcion' => 'Categoría de Habitación de Bebés',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juguetes-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Juguetes',
                'slug' => 'juguetes-bebe',
                'descripcion' => 'Categoría de Juguetes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'panales-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Pañales',
                'slug' => 'panales-bebe',
                'descripcion' => 'Categoría de Pañales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Ropa',
                'slug' => 'ropa-bebe',
                'descripcion' => 'Categoría de Ropa de Bebés',
            ]);
        };








        //--------------------Libros-------------------------------
        //--------------------Libros-------------------------------
        $categoria = MainCategory::where('slug', 'audiolibros')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '6',
                'nombre' => 'Audiolibros',
                'slug' => 'audiolibros',
                'descripcion' => 'Categoría de Audiolibros',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ebooks')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '6',
                'nombre' => 'eBooks',
                'slug' => 'ebooks',
                'descripcion' => 'Categoría de eBooks',
            ]);
        };

        $categoria = MainCategory::where('slug', 'libros')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '6',
                'nombre' => 'Libros',
                'slug' => 'libros',
                'descripcion' => 'Categoría de Libros',
            ]);
        };










        //--------------------Películas, Música y Juegos-------------------------------
        //--------------------Cine y TV-------------------------------
        $categoria = MainCategory::where('slug', 'blu-ray')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '7',
                'nombre' => 'Blu-ray',
                'slug' => 'blu-ray',
                'descripcion' => 'Categoría de Blu-ray',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dvd')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '7',
                'nombre' => 'DVD',
                'slug' => 'dvd',
                'descripcion' => 'Categoría de DVD',
            ]);
        };

        $categoria = MainCategory::where('slug', 'peliculas-y-series-digitales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '7',
                'nombre' => 'Películas y Series Digitales',
                'slug' => 'peliculas-y-series-digitales',
                'descripcion' => 'Categoría de Películas y Series Digitales',
            ]);
        };


        //--------------------Instrumentos Musicales-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-instrumentos-musicales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-instrumentos-musicales',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'amplificadores-y-efectos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Amplificadores y Efectos',
                'slug' => 'amplificadores-y-efectos',
                'descripcion' => 'Categoría de Amplificadores y Efectos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bajos-instrumentos-musicales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Bajos',
                'slug' => 'bajos-instrumentos-musicales',
                'descripcion' => 'Categoría de Bajos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'baterias-y-percusion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Baterías y Percusión',
                'slug' => 'baterias-y-percusion',
                'descripcion' => 'Categoría de Baterías y Percusión',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dj-y-karaoke')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'DJ y Karaoke',
                'slug' => 'dj-y-karaoke',
                'descripcion' => 'Categoría de DJ y Karaoke',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estudio-de-grabacion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Estudio de Grabación',
                'slug' => 'estudio-de-grabacion',
                'descripcion' => 'Categoría de Estudio de Grabación',
            ]);
        };

        $categoria = MainCategory::where('slug', 'guitarras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Guitarras',
                'slug' => 'guitarras',
                'descripcion' => 'Categoría de Guitarras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-de-cuerda')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Instrumentos de Cuerda',
                'slug' => 'instrumentos-de-cuerda',
                'descripcion' => 'Categoría de Instrumentos de Cuerda',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-de-metal')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Instrumentos de Metal',
                'slug' => 'instrumentos-de-metal',
                'descripcion' => 'Categoría de Instrumentos de Metal',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-de-viento')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Instrumentos de Viento',
                'slug' => 'instrumentos-de-viento',
                'descripcion' => 'Categoría de Instrumentos de Viento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'microfonos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Micrófonos',
                'slug' => 'microfonos',
                'descripcion' => 'Categoría de Micrófonos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sonido-en-vivo-y-escenario')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Sonido en Vivo y Escenario',
                'slug' => 'sonido-en-vivo-y-escenario',
                'descripcion' => 'Categoría de Sonido en Vivo y Escenario',
            ]);
        };

        $categoria = MainCategory::where('slug', 'teclados-y-midi')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Teclados y Midi',
                'slug' => 'teclados-y-midi',
                'descripcion' => 'Categoría de Teclados y Midi',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ukuleles')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Ukuleles',
                'slug' => 'ukuleles',
                'descripcion' => 'Categoría de Ukuleles',
            ]);
        };


        //--------------------Música-------------------------------
        $categoria = MainCategory::where('slug', 'cd-y-vinilos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '9',
                'nombre' => 'CD y Vinilos',
                'slug' => 'cd-y-vinilos',
                'descripcion' => 'Categoría de CD y Vinilos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'musica-digital')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '9',
                'nombre' => 'Música Digital',
                'slug' => 'musica-digital',
                'descripcion' => 'Categoría de Música Digital',
            ]);
        };


        //--------------------Videojuegos-------------------------------
        $categoria = MainCategory::where('slug', 'playstation')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'PlayStation',
                'slug' => 'playstation',
                'descripcion' => 'Categoría de PlayStation',
            ]);
        };

        $categoria = MainCategory::where('slug', 'xbox')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'Xbox',
                'slug' => 'xbox',
                'descripcion' => 'Categoría de Xbox',
            ]);
        };

        $categoria = MainCategory::where('slug', 'nintendo')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'Nintendo',
                'slug' => 'nintendo',
                'descripcion' => 'Categoría de Nintendo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'PC',
                'slug' => 'pc',
                'descripcion' => 'Categoría de PC',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mac-videojuegos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'MAC',
                'slug' => 'mac-videojuegos',
                'descripcion' => 'Categoría de MAC',
            ]);
        };

        $categoria = MainCategory::where('slug', 'servicios-de-juego-en-linea')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'Servicios de Juego en Línea',
                'slug' => 'servicios-de-juego-en-linea',
                'descripcion' => 'Categoría de Servicios de Juego en Línea',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-videojuegos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'Otros',
                'slug' => 'otros-videojuegos',
                'descripcion' => 'Categoría de Otros',
            ]);
        };
        








        //--------------------Electrónicos-------------------------------
        //--------------------Accesorios y Suministros-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-de-audio-en-casa')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios de Audio en Casa',
                'slug' => 'accesorios-de-audio-en-casa',
                'descripcion' => 'Categoría de Accesorios de Audio en Casa',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-de-celulares')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios de Celulares',
                'slug' => 'accesorios-de-celulares',
                'descripcion' => 'Categoría de Accesorios de Celulares',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-de-imagen-y-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios de Imagen y Sonido',
                'slug' => 'accesorios-de-imagen-y-sonido',
                'descripcion' => 'Categoría de Accesorios de Imagen y Sonido',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-de-oficina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios de Oficina',
                'slug' => 'accesorios-de-oficina',
                'descripcion' => 'Categoría de Accesorios de Oficina',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-electronicos-para-vehiculos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios Electrónicos para Vehículo',
                'slug' => 'accesorios-electronicos-para-vehiculos',
                'descripcion' => 'Categoría de Accesorios Electrónicos para Vehículo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-camaras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios para Cámaras',
                'slug' => 'accesorios-para-camaras',
                'descripcion' => 'Categoría de Accesorios para Cámaras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-computadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios para Computadoras',
                'slug' => 'accesorios-para-computadoras',
                'descripcion' => 'Categoría de Accesorios para Computadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-sistema-gps')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios para Sistema GPS',
                'slug' => 'accesorios-para-sistema-gps',
                'descripcion' => 'Categoría de Accesorios para Sistema GPS',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-televisores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios para Televisores',
                'slug' => 'accesorios-para-televisores',
                'descripcion' => 'Categoría de Accesorios para Televisores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'baterias-cargas-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Baterías, Cargas y Accesorios',
                'slug' => 'baterias-cargas-y-accesorios',
                'descripcion' => 'Categoría de Baterías, Cargas y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cables')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Cables',
                'slug' => 'cables',
                'descripcion' => 'Categoría de Cables',
            ]);
        };

        $categoria = MainCategory::where('slug', 'microfonos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Micrófonos',
                'slug' => 'microfonos',
                'descripcion' => 'Categoría de Micrófonos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'proteccion-de-alimentacion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Protección de Alimentación',
                'slug' => 'proteccion-de-alimentacion',
                'descripcion' => 'Categoría de Protección de Alimentación',
            ]);
        };

        $categoria = MainCategory::where('slug', 'soportes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Soportes',
                'slug' => 'soportes',
                'descripcion' => 'Categoría de Soportes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-accesorios-y-suministros')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Otros',
                'slug' => 'otros-accesorios-y-suministros',
                'descripcion' => 'Categoría de Otros',
            ]);
        };




        //--------------------Audífonos-------------------------------
        $categoria = MainCategory::where('slug', 'audifonos-de-diadema')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '12',
                'nombre' => 'Audífonos de Diadema',
                'slug' => 'audifonos-de-diadema',
                'descripcion' => 'Categoría de Audífonos de Diadema',
            ]);
        };

        $categoria = MainCategory::where('slug', 'audifonos-in-ear')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '12',
                'nombre' => 'Audífonos In Ear',
                'slug' => 'audifonos-in-ear',
                'descripcion' => 'Categoría de Audífonos In Ear',
            ]);
        };




        //--------------------Audio para el Hogar-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-audio-para-el-hogar')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-audio-para-el-hogar',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'audio-inalambrico-y-streaming')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Audio Inalámbrico y Streaming',
                'slug' => 'audio-inalambrico-y-streaming',
                'descripcion' => 'Categoría de Audio Inalámbrico y Streaming',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bocinas-hogar')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Bocinas',
                'slug' => 'bocinas-hogar',
                'descripcion' => 'Categoría de Bocinas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'home-theater')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Home Theater',
                'slug' => 'home-theater',
                'descripcion' => 'Categoría de Home Theater',
            ]);
        };

        $categoria = MainCategory::where('slug', 'radios-y-estereos-compactos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Radios y Estéreos Compactos',
                'slug' => 'radios-y-estereos-compactos',
                'descripcion' => 'Categoría de Radios y Estéreos Compactos',
            ]);
        };




        //--------------------Cámaras y Fotografía-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-camaras-y-fotografia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-camaras-y-fotografia',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'binoculares-y-telescopios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Binoculares y Telescopios',
                'slug' => 'binoculares-y-telescopios',
                'descripcion' => 'Categoría de Binoculares y Telescopios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'camaras-digitales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Cámaras Digitales',
                'slug' => 'camaras-digitales',
                'descripcion' => 'Categoría de Cámaras Digitales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estuches-y-bolsos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Estuches y Bolsos',
                'slug' => 'estuches-y-bolsos',
                'descripcion' => 'Categoría de Estuches y Bolsos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'flashes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Flashes',
                'slug' => 'flashes',
                'descripcion' => 'Categoría de Flashes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'fotografia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Fotografía',
                'slug' => 'fotografia',
                'descripcion' => 'Categoría de Fotografía',
            ]);
        };

        $categoria = MainCategory::where('slug', 'iluminacion-y-estudio')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Iluminación y Estudio',
                'slug' => 'iluminacion-y-estudio',
                'descripcion' => 'Categoría de Iluminación y Estudio',
            ]);
        };

        $categoria = MainCategory::where('slug', 'lentes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Lentes',
                'slug' => 'lentes',
                'descripcion' => 'Categoría de Lentes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tripodes-y-monopies')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Trípodes y Monopies',
                'slug' => 'tripodes-y-monopies',
                'descripcion' => 'Categoría de Trípodes y Monopies',
            ]);
        };

        $categoria = MainCategory::where('slug', 'video')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Video',
                'slug' => 'video',
                'descripcion' => 'Categoría de Video',
            ]);
        };




        //--------------------Consolas y Accesorios para Videojuegos-------------------------------
        $categoria = MainCategory::where('slug', 'playstation-consola')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '15',
                'nombre' => 'PlayStation',
                'slug' => 'playstation-consola',
                'descripcion' => 'Categoría de PlayStation',
            ]);
        };
        
        $categoria = MainCategory::where('slug', 'xbox-consola')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '15',
                'nombre' => 'Xbox',
                'slug' => 'xbox-consola',
                'descripcion' => 'Categoría de Xbox',
            ]);
        };

        $categoria = MainCategory::where('slug', 'nintendo-consola')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '15',
                'nombre' => 'Nintendo',
                'slug' => 'nintendo-consola',
                'descripcion' => 'Categoría de Nintendo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-consola')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '15',
                'nombre' => 'Otros',
                'slug' => 'otros-consola',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Electrónica para Autos y Vehículos-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-electronicos-para-vehiculos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'Accesorios Electrónicos para Vehículos',
                'slug' => 'accesorios-electronicos-para-vehiculos',
                'descripcion' => 'Categoría de Accesorios Electrónicos para Vehículos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'electronica-de-auto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'Electrónica de Auto',
                'slug' => 'electronica-de-auto',
                'descripcion' => 'Categoría de Electrónica de Auto',
            ]);
        };

        $categoria = MainCategory::where('slug', 'electronica-de-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'Electrónica de Moto',
                'slug' => 'electronica-de-moto',
                'descripcion' => 'Categoría de Electrónica de Moto',
            ]);
        };

        $categoria = MainCategory::where('slug', 'electronica-marina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'Electrónica Marina',
                'slug' => 'electronica-marina',
                'descripcion' => 'Categoría de Electrónica Marina',
            ]);
        };

        $categoria = MainCategory::where('slug', 'gps-electronica-vehiculos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'GPS',
                'slug' => 'gps-electronica-vehiculos',
                'descripcion' => 'Categoría de GPS',
            ]);
        };



        //--------------------Electrónicos de Oficina-------------------------------
        $categoria = MainCategory::where('slug', 'calculadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Calculadoras',
                'slug' => 'calculadoras',
                'descripcion' => 'Categoría de Calculadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'copiadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Copiadoras',
                'slug' => 'copiadoras',
                'descripcion' => 'Categoría de Copiadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'equipo-de-punto-de-venta-pos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Equipo de Punto de Venta (POS)',
                'slug' => 'equipo-de-punto-de-venta-pos',
                'descripcion' => 'Categoría de Equipo de Punto de Venta (POS)',
            ]);
        };

        $categoria = MainCategory::where('slug', 'escaneres-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Escáneres y Accesorios',
                'slug' => 'escaneres-y-accesorios',
                'descripcion' => 'Categoría de Escáneres y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'faxes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Faxes',
                'slug' => 'faxes',
                'descripcion' => 'Categoría de Faxes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'impresoras-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Impresoras y Accesorios',
                'slug' => 'impresoras-y-accesorios',
                'descripcion' => 'Categoría de Impresoras y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'proyectores-de-video-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Proyectores de Video y Accesorios',
                'slug' => 'proyectores-de-video-y-accesorios',
                'descripcion' => 'Categoría de Proyectores de Video y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-electronicos-oficina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Otros',
                'slug' => 'otros-electronicos-oficina',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Navegación Satelital y GPS-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-de-sistema-gps')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '18',
                'nombre' => 'Accesorios de Sistema GPS',
                'slug' => 'accesorios-de-sistema-gps',
                'descripcion' => 'Categoría de Accesorios de Sistema GPS',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistema-gps')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '18',
                'nombre' => 'Sistema GPS',
                'slug' => 'sistema-gps',
                'descripcion' => 'Categoría de Sistema GPS',
            ]);
        };




        //--------------------Tecnología Vestible-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-tecnologia-vestible')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-tecnologia-vestible',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'clips-brazo-y-pulseras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Clips, Brazo y Pulseras',
                'slug' => 'clips-brazo-y-pulseras',
                'descripcion' => 'Categoría de Clips, Brazo y Pulseras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'lentes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Lentes',
                'slug' => 'lentes',
                'descripcion' => 'Categoría de Lentes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'realidad-virtual')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Realidad Virtual',
                'slug' => 'realidad-virtual',
                'descripcion' => 'Categoría de Realidad Virtual',
            ]);
        };

        $categoria = MainCategory::where('slug', 'smartwatches')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Smartwatches',
                'slug' => 'smartwatches',
                'descripcion' => 'Categoría de Smartwatches',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-tecnologia-vestible')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Otros',
                'slug' => 'otros-tecnologia-vestible',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Teléfonos Celulares y Accesorios-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-telefonos-celulares')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '20',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-telefonos-celulares',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'celulares-con-contrato')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '20',
                'nombre' => 'Celulares con Contrato',
                'slug' => 'celulares-con-contrato',
                'descripcion' => 'Categoría de Celulares con Contrato',
            ]);
        };

        $categoria = MainCategory::where('slug', 'celulares-desbloqueados')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '20',
                'nombre' => 'Celulares Desbloqueados',
                'slug' => 'celulares-desbloqueados',
                'descripcion' => 'Categoría de Celulares Desbloqueados',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estuches-fundas-y-clips')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '20',
                'nombre' => 'Estuches, Fundas y Clips',
                'slug' => 'estuches-fundas-y-clips',
                'descripcion' => 'Categoría de Estuches, Fundas y Clips',
            ]);
        };







        //--------------------Televisión y Vídeo-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-tv-video')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-tv-video',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'conversores-tv-video')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Conversores',
                'slug' => 'conversores-tv-video',
                'descripcion' => 'Categoría de Conversores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dispositivos-para-streaming')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Dispositivos para Streaming',
                'slug' => 'dispositivos-para-streaming',
                'descripcion' => 'Categoría de Dispositivos para Streaming',
            ]);
        };

        $categoria = MainCategory::where('slug', 'proyectores-tv-video')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Proyectores',
                'slug' => 'proyectores-tv-video',
                'descripcion' => 'Categoría de Proyectores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'reproductores-y-grabadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Reproductores y Grabadoras',
                'slug' => 'reproductores-y-grabadoras',
                'descripcion' => 'Categoría de Reproductores y Grabadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistema-de-home-theater')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Sistema de Home Theater',
                'slug' => 'sistema-de-home-theater',
                'descripcion' => 'Categoría de Sistema de Home Theater',
            ]);
        };

        $categoria = MainCategory::where('slug', 'television-satelital')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Televisión Satelital',
                'slug' => 'television-satelital',
                'descripcion' => 'Categoría de Televisión Satelital',
            ]);
        };

        $categoria = MainCategory::where('slug', 'televisiones')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Televisiones',
                'slug' => 'televisiones',
                'descripcion' => 'Categoría de Televisiones',
            ]);
        };




        //--------------------Seguridad y Vigilancia-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-seguridad-vigilancia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '22',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-seguridad-vigilancia',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'equipos-seguridad-vigilancia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '22',
                'nombre' => 'Equipos',
                'slug' => 'equipos-seguridad-vigilancia',
                'descripcion' => 'Categoría de Equipos',
            ]);
        };












        //--------------------Computadoras-------------------------------
        //--------------------Accesorios para Computadora-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-de-audio-y-video')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios de Audio y Video',
                'slug' => 'accesorios-de-audio-y-video',
                'descripcion' => 'Categoría de Accesorios de Audio y Video',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-de-impresoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios de Impresoras',
                'slug' => 'accesorios-de-impresoras',
                'descripcion' => 'Categoría de Accesorios de Impresoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-disco-duro')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Disco Duro',
                'slug' => 'accesorios-para-disco-duro',
                'descripcion' => 'Categoría de Accesorios para Disco Duro',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-escaneres')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Escáneres',
                'slug' => 'accesorios-para-escaneres',
                'descripcion' => 'Categoría de Accesorios para Escáneres',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-monitor')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Monitor',
                'slug' => 'accesorios-para-monitor',
                'descripcion' => 'Categoría de Accesorios para Monitor',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-proyector')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Proyector',
                'slug' => 'accesorios-para-proyector',
                'descripcion' => 'Categoría de Accesorios para Proyector',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-tarjetas-de-memoria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Tarjetas de Memoria',
                'slug' => 'accesorios-para-tarjetas-de-memoria',
                'descripcion' => 'Categoría de Accesorios para Tarjetas de Memoria',
            ]);
        };

        $categoria = MainCategory::where('slug', 'adaptadores-para-cables')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Adaptadores para Cables',
                'slug' => 'adaptadores-para-cables',
                'descripcion' => 'Categoría de Adaptadores para Cables',
            ]);
        };

        $categoria = MainCategory::where('slug', 'alimentacion-ininterrumpida-ups')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Alimentación Ininterrumpida (UPS)',
                'slug' => 'alimentacion-ininterrumpida-ups',
                'descripcion' => 'Categoría de Alimentación Ininterrumpida (UPS)',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bases-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Bases',
                'slug' => 'bases-pc',
                'descripcion' => 'Categoría de Bases',
            ]);
        };

        $categoria = MainCategory::where('slug', 'baterias-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Baterías',
                'slug' => 'baterias-pc',
                'descripcion' => 'Categoría de Baterías',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cables-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Cables',
                'slug' => 'cables-pc',
                'descripcion' => 'Categoría de Cables',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cargadores-y-adaptadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Cargadores y Adaptadores',
                'slug' => 'cargadores-y-adaptadores',
                'descripcion' => 'Categoría de Cargadores y Adaptadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dispositivos-de-entrada')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Dispositivos de Entrada',
                'slug' => 'dispositivos-de-entrada',
                'descripcion' => 'Categoría de Dispositivos de Entrada',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estantes-y-gabinetes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Estantes y Gabinetes',
                'slug' => 'estantes-y-gabinetes',
                'descripcion' => 'Categoría de Estantes y Gabinetes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'hardware-de-juego')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Hardware de Juego',
                'slug' => 'hardware-de-juego',
                'descripcion' => 'Categoría de Hardware de Juego',
            ]);
        };

        $categoria = MainCategory::where('slug', 'limpieza-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Limpieza',
                'slug' => 'limpieza-pc',
                'descripcion' => 'Categoría de Limpieza',
            ]);
        };

        $categoria = MainCategory::where('slug', 'repuestos-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Repuestos',
                'slug' => 'repuestos-pc',
                'descripcion' => 'Categoría de Repuestos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tarjetas-de-memoria-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Tarjetas de Memoria',
                'slug' => 'tarjetas-de-memoria-pc',
                'descripcion' => 'Categoría de Tarjetas de Memoria',
            ]);
        };

        $categoria = MainCategory::where('slug', 'teclados-mouse-y-perifericos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Teclados, Mouse y Periféricos',
                'slug' => 'teclados-mouse-y-perifericos',
                'descripcion' => 'Categoría de Teclados, Mouse y Periféricos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tinta-y-toner-para-impresoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Tinta y Tóner para Impresoras',
                'slug' => 'tinta-y-toner-para-impresoras',
                'descripcion' => 'Categoría de Tinta y Tóner para Impresoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'usb-dispositivos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'USB Dispositivos',
                'slug' => 'usb-dispositivos',
                'descripcion' => 'Categoría de USB Dispositivos',
            ]);
        };




        //--------------------Accesorios para Tablets-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-tablets')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-tablets',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cargadores-y-adaptadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Cargadores y Adaptadores',
                'slug' => 'cargadores-y-adaptadores',
                'descripcion' => 'Categoría de Cargadores y Adaptadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cubiertas-y-estuches')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Cubiertas y Estuches',
                'slug' => 'cubiertas-y-estuches',
                'descripcion' => 'Categoría de Cubiertas y Estuches',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estuches-para-teclados')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Estuches para Teclados',
                'slug' => 'estuches-para-teclados',
                'descripcion' => 'Categoría de Estuches para Teclados',
            ]);
        };

        $categoria = MainCategory::where('slug', 'fundas-tablets')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Fundas',
                'slug' => 'fundas-tablets',
                'descripcion' => 'Categoría de Fundas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pencil-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Pencil',
                'slug' => 'pencil-tablet',
                'descripcion' => 'Categoría de Pencil',
            ]);
        };

        $categoria = MainCategory::where('slug', 'protectores-de-pantalla-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Protectores de Pantalla',
                'slug' => 'protectores-de-pantalla-tablet',
                'descripcion' => 'Categoría de Protectores de Pantalla',
            ]);
        };

        $categoria = MainCategory::where('slug', 'repuestos-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Repuestos',
                'slug' => 'repuestos-tablet',
                'descripcion' => 'Categoría de Repuestos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'soportes-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Soportes',
                'slug' => 'soportes-tablet',
                'descripcion' => 'Categoría de Soportes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'teclados-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Teclados',
                'slug' => 'teclados-tablet',
                'descripcion' => 'Categoría de Teclados',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-tablet-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Otros',
                'slug' => 'otros-tablet-accesorios',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Almacenamiento Externo de Datos-------------------------------
        $categoria = MainCategory::where('slug', 'discos-duros-externos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Discos Duros Externos',
                'slug' => 'discos-duros-externos',
                'descripcion' => 'Categoría de Discos Duros Externos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'discos-duros-internos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Discos Duros Internos',
                'slug' => 'discos-duros-internos',
                'descripcion' => 'Categoría de Discos Duros Internos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'unidades-de-estado-solido-externo')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Unidades de Estado Sólido Externo',
                'slug' => 'unidades-de-estado-solido-externo',
                'descripcion' => 'Categoría de Unidades de Estado Sólido Externo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'unidades-de-estado-solido-interno')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Unidades de Estado Sólido Interno',
                'slug' => 'unidades-de-estado-solido-interno',
                'descripcion' => 'Categoría de Unidades de Estado Sólido Interno',
            ]);
        };

        $categoria = MainCategory::where('slug', 'unidades-flash-usb')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Unidades Flash USB',
                'slug' => 'unidades-flash-usb',
                'descripcion' => 'Categoría de Unidades Flash USB',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-almacenamiento-datos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Otros',
                'slug' => 'otros-almacenamiento-datos',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Componentes de Computadoras-------------------------------
        $categoria = MainCategory::where('slug', 'componentes-de-laptop')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '26',
                'nombre' => 'Componentes de Laptop',
                'slug' => 'componentes-de-laptop',
                'descripcion' => 'Categoría de Componentes de Laptop',
            ]);
        };

        $categoria = MainCategory::where('slug', 'componentes-externos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '26',
                'nombre' => 'Componentes Externos',
                'slug' => 'componentes-externos',
                'descripcion' => 'Categoría de Componentes Externos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'componentes-internos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '26',
                'nombre' => 'Componentes Internos',
                'slug' => 'componentes-internos',
                'descripcion' => 'Categoría de Componentes Internos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-componentes-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '26',
                'nombre' => 'Otros',
                'slug' => 'otros-componentes-pc',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Computadoras y Tablets-------------------------------
        $categoria = MainCategory::where('slug', 'computadoras-de-escritorio')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '27',
                'nombre' => 'Computadoras de Escritorio',
                'slug' => 'computadoras-de-escritorio',
                'descripcion' => 'Categoría de Computadoras de Escritorio',
            ]);
        };

        $categoria = MainCategory::where('slug', 'laptops')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '27',
                'nombre' => 'Laptops',
                'slug' => 'laptops',
                'descripcion' => 'Categoría de Laptops',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tablets')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '27',
                'nombre' => 'Tablets',
                'slug' => 'tablets',
                'descripcion' => 'Categoría de Tablets',
            ]);
        };



        //--------------------Escáneres-------------------------------
        $categoria = MainCategory::where('slug', 'escaneres')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '28',
                'nombre' => 'Escáneres',
                'slug' => 'escaneres',
                'descripcion' => 'Categoría de Escáneres',
            ]);
        };




        //--------------------Impresoras-------------------------------
        $categoria = MainCategory::where('slug', 'impresoras-de-fotografias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '29',
                'nombre' => 'Impresoras de Fotografías',
                'slug' => 'impresoras-de-fotografias',
                'descripcion' => 'Categoría de Impresoras de Fotografías',
            ]);
        };

        $categoria = MainCategory::where('slug', 'impresoras-de-inyeccion-de-tinta')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '29',
                'nombre' => 'Impresoras de Inyección de Tinta',
                'slug' => 'impresoras-de-inyeccion-de-tinta',
                'descripcion' => 'Categoría de Impresoras de Inyección de Tinta',
            ]);
        };

        $categoria = MainCategory::where('slug', 'impresoras-laser')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '29',
                'nombre' => 'Impresoras Láser',
                'slug' => 'impresoras-laser',
                'descripcion' => 'Categoría de Impresoras Láser',
            ]);
        };

        $categoria = MainCategory::where('slug', 'impresoras-multifuncionales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '29',
                'nombre' => 'Impresoras Multifuncionales',
                'slug' => 'impresoras-multifuncionales',
                'descripcion' => 'Categoría de Impresoras Multifuncionales',
            ]);
        };





        //--------------------Monitores-------------------------------
        $categoria = MainCategory::where('slug', 'monitores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '30',
                'nombre' => 'Monitores',
                'slug' => 'monitores',
                'descripcion' => 'Categoría de Monitores',
            ]);
        };









        //--------------------Automotriz-------------------------------
        //--------------------Accesorios Exteriores-------------------------------
        $categoria = MainCategory::where('slug', 'acampanados-y-molduras-de-guardabarros')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Acampanados y Molduras de Guardabarros',
                'slug' => 'acampanados-y-molduras-de-guardabarros',
                'descripcion' => 'Categoría de Acampanados y Molduras de Guardabarros',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-compuerta-trasera-y-forro')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Accesorios para Compuerta Trasera y Forro',
                'slug' => 'accesorios-para-compuerta-trasera-y-forro',
                'descripcion' => 'Categoría de Accesorios para Compuerta Trasera y Forro',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-remolques')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Accesorios para Remolques',
                'slug' => 'accesorios-para-remolques',
                'descripcion' => 'Categoría de Accesorios para Remolques',
            ]);
        };

        $categoria = MainCategory::where('slug', 'administracion-de-carga')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Administración de Carga',
                'slug' => 'administracion-de-carga',
                'descripcion' => 'Categoría de Administración de Carga',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bocinas-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Bocinas y Accesorios',
                'slug' => 'bocinas-y-accesorios',
                'descripcion' => 'Categoría de Bocinas y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calcomanias-y-etiquetas-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Calcomanías y Etiquetas',
                'slug' => 'calcomanias-y-etiquetas-automotriz',
                'descripcion' => 'Categoría de Calcomanías y Etiquetas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'emblemas-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Emblemas',
                'slug' => 'emblemas-automotriz',
                'descripcion' => 'Categoría de Emblemas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'espejos-y-partes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Espejos y Partes',
                'slug' => 'espejos-y-partes-automotriz',
                'descripcion' => 'Categoría de Espejos y Partes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'parachoques-y-accesorios-para-parachoques')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Parachoques y Accesorios para Parachoques',
                'slug' => 'parachoques-y-accesorios-para-parachoques',
                'descripcion' => 'Categoría de Parachoques y Accesorios para Parachoques',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-accesorios-exteriores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Otros',
                'slug' => 'otros-accesorios-exteriores',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Accesorios Interiores-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-automotriz',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ambientadores-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Ambientadores',
                'slug' => 'ambientadores-automotriz',
                'descripcion' => 'Categoría de Ambientadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'alfombras-y-tapetes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Alfombras y Tapetes',
                'slug' => 'alfombras-y-tapetes-automotriz',
                'descripcion' => 'Categoría de Alfombras y Tapetes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'forros-para-asiento-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Forros para Asiento',
                'slug' => 'forros-para-asiento-automotriz',
                'descripcion' => 'Categoría de Forros para Asiento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pedales-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Pedales',
                'slug' => 'pedales-automotriz',
                'descripcion' => 'Categoría de Pedales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'proteccion-antirrobo-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Protección Antirrobo',
                'slug' => 'proteccion-antirrobo-automotriz',
                'descripcion' => 'Categoría de Protección Antirrobo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'volantes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Volantes',
                'slug' => 'volantes-automotriz',
                'descripcion' => 'Categoría de Volantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-accesorios-interiores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Otros',
                'slug' => 'otros-accesorios-interiores',
                'descripcion' => 'Categoría de Otros',
            ]);
        };






        //--------------------Aceites y Fluidos-------------------------------
        $categoria = MainCategory::where('slug', 'aceites-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Aceites',
                'slug' => 'aceites-automotriz',
                'descripcion' => 'Categoría de Aceites',
            ]);
        };

        $categoria = MainCategory::where('slug', 'aditivos-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Aditivos',
                'slug' => 'aditivos-automotriz',
                'descripcion' => 'Categoría de Aditivos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'anticongelantes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Anticongelantes',
                'slug' => 'anticongelantes-automotriz',
                'descripcion' => 'Categoría de Anticongelantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'fluidos-de-transmision-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Fluidos de Transmisión',
                'slug' => 'fluidos-de-transmision-automotriz',
                'descripcion' => 'Categoría de Fluidos de Transmisión',
            ]);
        };

        $categoria = MainCategory::where('slug', 'limpiadores-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Limpiadores',
                'slug' => 'limpiadores-automotriz',
                'descripcion' => 'Categoría de Limpiadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'liquidos-de-direccion-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Líquidos de Dirección',
                'slug' => 'liquidos-de-direccion-automotriz',
                'descripcion' => 'Categoría de Líquidos de Dirección',
            ]);
        };

        $categoria = MainCategory::where('slug', 'liquidos-de-freno-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Líquidos de Freno',
                'slug' => 'liquidos-de-freno-automotriz',
                'descripcion' => 'Categoría de Líquidos de Freno',
            ]);
        };

        $categoria = MainCategory::where('slug', 'lubricantes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Lubricantes',
                'slug' => 'lubricantes-automotriz',
                'descripcion' => 'Categoría de Lubricantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'refrigerantes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Refrigerantes',
                'slug' => 'refrigerantes-automotriz',
                'descripcion' => 'Categoría de Refrigerantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'selladores-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Selladores',
                'slug' => 'selladores-automotriz',
                'descripcion' => 'Categoría de Selladores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-aceites-y-fluidos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Otros',
                'slug' => 'otros-aceites-y-fluidos',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Cuidado Automotriz-------------------------------
        $categoria = MainCategory::where('slug', 'cuidado-de-neumaticos-y-ruedas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Cuidado de Neumáticos y Ruedas',
                'slug' => 'cuidado-de-neumaticos-y-ruedas',
                'descripcion' => 'Categoría de Cuidado de Neumáticos y Ruedas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-del-interior-del-vehiculo')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Cuidado del Interior del Vehículo',
                'slug' => 'cuidado-del-interior-del-vehiculo',
                'descripcion' => 'Categoría de Cuidado del Interior del Vehículo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-exterior')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Cuidado Exterior',
                'slug' => 'cuidado-exterior',
                'descripcion' => 'Categoría de Cuidado Exterior',
            ]);
        };

        $categoria = MainCategory::where('slug', 'kits-de-limpieza')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Kits de Limpieza',
                'slug' => 'kits-de-limpieza',
                'descripcion' => 'Categoría de Kits de Limpieza',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-automotriz',
                'descripcion' => 'Categoría de Otros',
            ]);
        };






        //--------------------Herramientas y Equipos-------------------------------
        $categoria = MainCategory::where('slug', 'cables-puente-cargadores-de-bateria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Cables Puente, Cargadores de Batería',
                'slug' => 'cables-puente-cargadores-de-bateria',
                'descripcion' => 'Categoría de Cables Puente, Cargadores de Batería',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cajas-de-herramientas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Cajas de Herramientas',
                'slug' => 'cajas-de-herramientas',
                'descripcion' => 'Categoría de Cajas de Herramientas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'compresores-de-aire-e-infladores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Compresores de Aire e Infladores',
                'slug' => 'compresores-de-aire-e-infladores',
                'descripcion' => 'Categoría de Compresores de Aire e Infladores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'equipo-de-garaje')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Equipo de Garaje',
                'slug' => 'equipo-de-garaje',
                'descripcion' => 'Categoría de Equipo de Garaje',
            ]);
        };

        $categoria = MainCategory::where('slug', 'extractores-y-deparadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Extractores y Separadores',
                'slug' => 'extractores-y-deparadores',
                'descripcion' => 'Categoría de Extractores y Separadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-bujias-e-ignicion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Bujías e Ignición',
                'slug' => 'herramientas-de-bujias-e-ignicion',
                'descripcion' => 'Categoría de Herramientas de Bujías e Ignición',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-diagnostico-test-y-medidores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Diagnóstico, Test y Medidores',
                'slug' => 'herramientas-de-diagnostico-test-y-medidores',
                'descripcion' => 'Categoría de Herramientas de Diagnóstico, Test y Medidores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-direccion-y-suspension')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Dirección y Suspensión',
                'slug' => 'herramientas-de-direccion-y-suspension',
                'descripcion' => 'Categoría de Herramientas de Dirección y Suspensión',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-frenos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Frenos',
                'slug' => 'herramientas-de-frenos',
                'descripcion' => 'Categoría de Herramientas de Frenos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-mano')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Mano',
                'slug' => 'herramientas-de-mano',
                'descripcion' => 'Categoría de Herramientas de Mano',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-neumaticos-y-ruedas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Neumáticos y Ruedas',
                'slug' => 'herramientas-de-neumaticos-y-ruedas',
                'descripcion' => 'Categoría de Herramientas de Neumáticos y Ruedas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-reparacion-de-carroceria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Reparación de Carrocería',
                'slug' => 'herramientas-de-reparacion-de-carroceria',
                'descripcion' => 'Categoría de Herramientas de Reparación de Carrocería',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-soldadura')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Soldadura',
                'slug' => 'herramientas-de-soldadura',
                'descripcion' => 'Categoría de Herramientas de Soldadura',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-del-sistema-de-aceite-y-equipamiento')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas del Sistema de Aceite y Equipamiento',
                'slug' => 'herramientas-del-sistema-de-aceite-y-equipamiento',
                'descripcion' => 'Categoría de Herramientas del Sistema de Aceite y Equipamiento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-y-equipos-de-motor')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas y Equipos de Motor',
                'slug' => 'herramientas-y-equipos-de-motor',
                'descripcion' => 'Categoría de Herramientas y Equipos de Motor',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juegos-de-herramientas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Juegos de Herramientas',
                'slug' => 'juegos-de-herramientas',
                'descripcion' => 'Categoría de Juegos de Herramientas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'remachadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Remachadoras',
                'slug' => 'remachadoras',
                'descripcion' => 'Categoría de Remachadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-herramientas-y-equipos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Otros',
                'slug' => 'otros-herramientas-y-equipos',
                'descripcion' => 'Categoría de Otros',
            ]);
        };






        //--------------------Luces y Accesorios de Iluminación-------------------------------
        $categoria = MainCategory::where('slug', 'bombillos-luces-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Bombillos',
                'slug' => 'bombillos-luces-accesorios',
                'descripcion' => 'Categoría de Bombillos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'iluminacion-de-todoterreno')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Iluminación de Todoterreno',
                'slug' => 'iluminacion-de-todoterreno',
                'descripcion' => 'Categoría de Iluminación de Todoterreno',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juegos-de-piezas-y-componentes-de-iluminacion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Juegos de Piezas y Componentes de Iluminación',
                'slug' => 'juegos-de-piezas-y-componentes-de-iluminacion',
                'descripcion' => 'Categoría de Juegos de Piezas y Componentes de Iluminación',
            ]);
        };

        $categoria = MainCategory::where('slug', 'kits-de-conversion-de-luces')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Kits de Conversión de Luces',
                'slug' => 'kits-de-conversion-de-luces',
                'descripcion' => 'Categoría de Kits de Conversión de Luces',
            ]);
        };

        $categoria = MainCategory::where('slug', 'luces-de-emergencia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Luces de Emergencia',
                'slug' => 'luces-de-emergencia',
                'descripcion' => 'Categoría de Luces de Emergencia',
            ]);
        };

        $categoria = MainCategory::where('slug', 'luces-para-remolque')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Luces para Remolque',
                'slug' => 'luces-para-remolque',
                'descripcion' => 'Categoría de Luces para Remolque',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-luces-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Otros',
                'slug' => 'otros-luces-y-accesorios',
                'descripcion' => 'Categoría de Otros',
            ]);
        };




        //--------------------Motos, Accesorios y Piezas-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-motos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-motos',
                'descripcion' => 'Categoría de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'fluidos-y-mantenimiento-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Fluidos y Mantenimiento',
                'slug' => 'fluidos-y-mantenimiento-moto',
                'descripcion' => 'Categoría de Fluidos y Mantenimiento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'neumaticos-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Neumáticos',
                'slug' => 'neumaticos-moto',
                'descripcion' => 'Categoría de Neumáticos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'repuestos-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Repuestos',
                'slug' => 'repuestos-moto',
                'descripcion' => 'Categoría de Repuestos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-y-accesorios-de-proteccion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Ropa y Accesorios de Protección',
                'slug' => 'ropa-y-accesorios-de-proteccion',
                'descripcion' => 'Categoría de Ropa y Accesorios de Protección',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ruedas-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Ruedas',
                'slug' => 'ruedas-moto',
                'descripcion' => 'Categoría de Ruedas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Otros',
                'slug' => 'otros-moto',
                'descripcion' => 'Categoría de Otros',
            ]);
        };




        //--------------------Neumáticos y Ruedas-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-y-repuestos-neumaticos-ruedas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '38',
                'nombre' => 'Accesorios y Repuestos',
                'slug' => 'accesorios-y-repuestos-neumaticos-ruedas',
                'descripcion' => 'Categoría de Accesorios y Repuestos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'neumaticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '38',
                'nombre' => 'Neumáticos',
                'slug' => 'neumaticos',
                'descripcion' => 'Categoría de Neumáticos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ruedas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '38',
                'nombre' => 'Ruedas',
                'slug' => 'ruedas',
                'descripcion' => 'Categoría de Ruedas',
            ]);
        };




        //--------------------Pintura y Suministros de Pintura-------------------------------
        $categoria = MainCategory::where('slug', 'pinturas-y-accesorios-de-pintura')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '39',
                'nombre' => 'Pinturas y Accesorios de Pintura',
                'slug' => 'pinturas-y-accesorios-de-pintura',
                'descripcion' => 'Categoría de Pinturas y Accesorios de Pintura',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pistolas-y-accesorios-de-pintura')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '39',
                'nombre' => 'Pistolas y Accesorios de Pintura',
                'slug' => 'pistolas-y-accesorios-de-pintura',
                'descripcion' => 'Categoría de Pistolas y Accesorios de Pintura',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pulitura-vehiculos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '39',
                'nombre' => 'Pulitura Vehículos',
                'slug' => 'pulitura-vehiculos',
                'descripcion' => 'Categoría de Pulitura Vehículos',
            ]);
        };



        //--------------------Repuestos-------------------------------
        $categoria = MainCategory::where('slug', 'arranques-y-alternadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Arranques y Alternadores',
                'slug' => 'arranques-y-alternadores',
                'descripcion' => 'Categoría de Arranques y Alternadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'baterias-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Baterías y Accesorios',
                'slug' => 'baterias-y-accesorios',
                'descripcion' => 'Categoría de Baterías y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cables-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Cables',
                'slug' => 'cables-repuestos',
                'descripcion' => 'Categoría de Cables',
            ]);
        };

        $categoria = MainCategory::where('slug', 'correas-y-tensores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Correas y Tensores',
                'slug' => 'correas-y-tensores',
                'descripcion' => 'Categoría de Correas y Tensores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'direccion-y-suspension')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Dirección y Suspensión',
                'slug' => 'direccion-y-suspension',
                'descripcion' => 'Categoría de Dirección y Suspensión',
            ]);
        };

        $categoria = MainCategory::where('slug', 'embellecedores-y-accesorios-para-carroceria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Embellecedores y Accesorios para Carrocería',
                'slug' => 'embellecedores-y-accesorios-para-carroceria',
                'descripcion' => 'Categoría de Embellecedores y Accesorios para Carrocería',
            ]);
        };

        $categoria = MainCategory::where('slug', 'encendido-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Encendido y Accesorios',
                'slug' => 'encendido-y-accesorios',
                'descripcion' => 'Categoría de Encendido y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'filtros-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Filtros',
                'slug' => 'filtros-repuestos',
                'descripcion' => 'Categoría de Filtros',
            ]);
        };

        $categoria = MainCategory::where('slug', 'frenos-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Frenos',
                'slug' => 'frenos-repuestos',
                'descripcion' => 'Categoría de Frenos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'interruptores-y-reles')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Interruptores y Relés',
                'slug' => 'interruptores-y-reles',
                'descripcion' => 'Categoría de Interruptores y Relés',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juntas-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Juntas',
                'slug' => 'juntas-repuestos',
                'descripcion' => 'Categoría de Juntas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'limpiaparabrisas-y-partes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Limpiaparabrisas y Partes',
                'slug' => 'limpiaparabrisas-y-partes',
                'descripcion' => 'Categoría de Limpiaparabrisas y Partes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'luz-y-electricidad-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Luz y Electricidad',
                'slug' => 'luz-y-electricidad-repuestos',
                'descripcion' => 'Categoría de Luz y Electricidad',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mallas-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Mallas',
                'slug' => 'mallas-repuestos',
                'descripcion' => 'Categoría de Mallas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'motores-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Motores',
                'slug' => 'motores-repuestos',
                'descripcion' => 'Categoría de Motores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'motores-y-piezas-del-motor')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Motores y Piezas del Motor',
                'slug' => 'motores-y-piezas-del-motor',
                'descripcion' => 'Categoría de Motores y Piezas del Motor',
            ]);
        };

        $categoria = MainCategory::where('slug', 'reguladores-y-motores-de-ventana')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Reguladores y Motores de Ventana',
                'slug' => 'reguladores-y-motores-de-ventana',
                'descripcion' => 'Categoría de Reguladores y Motores de Ventana',
            ]);
        };

        $categoria = MainCategory::where('slug', 'rodamientos-y-juntas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Rodamientos y Juntas',
                'slug' => 'rodamientos-y-juntas',
                'descripcion' => 'Categoría de Rodamientos y Juntas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sensores-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Sensores',
                'slug' => 'sensores-repuestos',
                'descripcion' => 'Categoría de Sensores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistema-de-direccion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Sistema de Dirección',
                'slug' => 'sistema-de-direccion',
                'descripcion' => 'Categoría de Sistema de Dirección',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistemas-de-escape')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Sistemas de Escape',
                'slug' => 'sistemas-de-escape',
                'descripcion' => 'Categoría de Sistemas de Escape',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistemas-de-refrigeracion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Sistemas de Refrigeración',
                'slug' => 'sistemas-de-refrigeracion',
                'descripcion' => 'Categoría de Sistemas de Refrigeración',
            ]);
        };

        $categoria = MainCategory::where('slug', 'suministro-y-tratamiento-de-combustible')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Suministro y Tratamiento de Combustible',
                'slug' => 'suministro-y-tratamiento-de-combustible',
                'descripcion' => 'Categoría de Suministro y Tratamiento de Combustible',
            ]);
        };

        $categoria = MainCategory::where('slug', 'traccion-y-transmision')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Tracción y Transmisión',
                'slug' => 'traccion-y-transmision',
                'descripcion' => 'Categoría de Tracción y Transmisión',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Otros',
                'slug' => 'otros-repuestos',
                'descripcion' => 'Categoría de Otros',
            ]);
        };



        //--------------------Sonido-------------------------------
        $categoria = MainCategory::where('slug', 'antenas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Antenas',
                'slug' => 'antenas-sonido',
                'descripcion' => 'Categoría de Antenas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bazookas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Bazookas',
                'slug' => 'bazookas-sonido',
                'descripcion' => 'Categoría de Bazookas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cables-y-conectores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Cables y Conectores',
                'slug' => 'cables-y-conectores-sonido',
                'descripcion' => 'Categoría de Cables y Conectores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cajas-acusticas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Cajas Acústicas',
                'slug' => 'cajas-acusticas-sonido',
                'descripcion' => 'Categoría de Cajas Acústicas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'capacitores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Capacitores',
                'slug' => 'capacitores-sonido',
                'descripcion' => 'Categoría de Capacitores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'controles-remotos-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Controles Remotos',
                'slug' => 'controles-remotos-sonido',
                'descripcion' => 'Categoría de Controles Remotos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cornetas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Cornetas',
                'slug' => 'cornetas-sonido',
                'descripcion' => 'Categoría de Cornetas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'difusores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Difusores',
                'slug' => 'difusores-sonido',
                'descripcion' => 'Categoría de Difusores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'drivers-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Drivers',
                'slug' => 'drivers-sonido',
                'descripcion' => 'Categoría de Drivers',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ecualizadores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Ecualizadores',
                'slug' => 'ecualizadores-sonido',
                'descripcion' => 'Categoría de Ecualizadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pantallas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Pantallas',
                'slug' => 'pantallas-sonido',
                'descripcion' => 'Categoría de Pantallas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'plantas-y-ecualizadores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Plantas y Ecualizadores',
                'slug' => 'plantas-y-ecualizadores-sonido',
                'descripcion' => 'Categoría de Plantas y Ecualizadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'reproductores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Reproductores',
                'slug' => 'reproductores-sonido',
                'descripcion' => 'Categoría de Reproductores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'subwoofers-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'SubWoofers',
                'slug' => 'subwoofers-sonido',
                'descripcion' => 'Categoría de SubWoofers',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tweeters-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Tweeters',
                'slug' => 'tweeters-sonido',
                'descripcion' => 'Categoría de Tweeters',
            ]);
        };

        $categoria = MainCategory::where('slug', 'woofers-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Woofers',
                'slug' => 'woofers-sonido',
                'descripcion' => 'Categoría de Woofers',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Otros',
                'slug' => 'otros-sonido',
                'descripcion' => 'Categoría de Otros',
            ]);
        };










        //--------------------Alimentos y Bebidas-------------------------------
        //--------------------Bebidas-------------------------------
        $categoria = MainCategory::where('slug', 'aguas-bebidas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Aguas',
                'slug' => 'aguas-bebidas',
                'descripcion' => 'Categoría de Aguas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bebidas-blancas-y-licores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Bebidas Blancas y Licores',
                'slug' => 'bebidas-blancas-y-licores',
                'descripcion' => 'Categoría de Bebidas Blancas y Licores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bebidas-deportivas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Bebidas Deportivas',
                'slug' => 'bebidas-deportivas',
                'descripcion' => 'Categoría de Bebidas Deportivas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bebidas-energeticas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Bebidas Energéticas',
                'slug' => 'bebidas-energeticas',
                'descripcion' => 'Categoría de Bebidas Energéticas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cerveza')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Cerveza',
                'slug' => 'cerveza',
                'descripcion' => 'Categoría de Cerveza',
            ]);
        };

        $categoria = MainCategory::where('slug', 'jugos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Jugos',
                'slug' => 'jugos',
                'descripcion' => 'Categoría de Jugos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'refrescos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Refrescos',
                'slug' => 'refrescos',
                'descripcion' => 'Categoría de Refrescos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'vinos-y-espumantes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Vinos y Espumantes',
                'slug' => 'vinos-y-espumantes',
                'descripcion' => 'Categoría de Vinos y Espumantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-bebidas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Otros',
                'slug' => 'otros-bebidas',
                'descripcion' => 'Categoría de Otros',
            ]);
        };




        //--------------------Comestibles-------------------------------
        $categoria = MainCategory::where('slug', 'aceites-y-vinagres')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Aceites y Vinagres',
                'slug' => 'aceites-y-vinagres',
                'descripcion' => 'Categoría de Aceites y Vinagres',
            ]);
        };

        $categoria = MainCategory::where('slug', 'alimentos-instantaneos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Alimentos Instantáneos',
                'slug' => 'alimentos-instantaneos',
                'descripcion' => 'Categoría de Alimentos Instantáneos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'arroz-legumbres-y-semillas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Arroz, Legumbres y Semillas',
                'slug' => 'arroz-legumbres-y-semillas',
                'descripcion' => 'Categoría de Arroz, Legumbres y Semillas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'azucar-y-endulzantes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Azúcar y Endulzantes',
                'slug' => 'azucar-y-endulzantes',
                'descripcion' => 'Categoría de Azúcar y Endulzantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cereales-y-barras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Cereales y Barras',
                'slug' => 'cereales-y-barras',
                'descripcion' => 'Categoría de Cereales y Barras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dulces-y-chocolates')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Dulces y Chocolates',
                'slug' => 'dulces-y-chocolates',
                'descripcion' => 'Categoría de Dulces y Chocolates',
            ]);
        };

        $categoria = MainCategory::where('slug', 'infusiones')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Infusiones',
                'slug' => 'infusiones',
                'descripcion' => 'Categoría de Infusiones',
            ]);
        };

        $categoria = MainCategory::where('slug', 'leches-y-cremas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Leches y Cremas',
                'slug' => 'leches-y-cremas',
                'descripcion' => 'Categoría de Leches y Cremas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mermeladas-dulces-y-miel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Mermeladas, Dulces y Miel',
                'slug' => 'mermeladas-dulces-y-miel',
                'descripcion' => 'Categoría de Mermeladas, Dulces y Miel',
            ]);
        };

        $categoria = MainCategory::where('slug', 'panaderia-y-reposteria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Panadería y Repostería',
                'slug' => 'panaderia-y-reposteria',
                'descripcion' => 'Categoría de Panadería y Repostería',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pastas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Pastas',
                'slug' => 'pastas',
                'descripcion' => 'Categoría de Pastas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'saborizantes-y-jarabes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Saborizantes y Jarabes',
                'slug' => 'saborizantes-y-jarabes',
                'descripcion' => 'Categoría de Saborizantes y Jarabes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'salsas-y-condimentos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Salsas y Condimentos',
                'slug' => 'salsas-y-condimentos',
                'descripcion' => 'Categoría de Salsas y Condimentos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'snacks')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Snacks',
                'slug' => 'snacks',
                'descripcion' => 'Categoría de Snacks',
            ]);
        };

        $categoria = MainCategory::where('slug', 'yogures')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Yogures',
                'slug' => 'yogures',
                'descripcion' => 'Categoría de Yogures',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-comestibles')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Otros',
                'slug' => 'otros-comestibles',
                'descripcion' => 'Categoría de Otros',
            ]);
        };




        //--------------------Comida Preparada-------------------------------
        $categoria = MainCategory::where('slug', 'almuerzos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Almuerzos',
                'slug' => 'almuerzos',
                'descripcion' => 'Categoría de Almuerzos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'arepas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Arepas',
                'slug' => 'arepas',
                'descripcion' => 'Categoría de Arepas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bandejas-dulces-y-saladas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Bandejas Dulces y Saladas',
                'slug' => 'bandejas-dulces-y-saladas',
                'descripcion' => 'Categoría de Bandejas Dulces y Saladas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'comida-preparada')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Comida Preparada',
                'slug' => 'comida-preparada',
                'descripcion' => 'Categoría de Comida Preparada',
            ]);
        };

        $categoria = MainCategory::where('slug', 'desayunos-y-meriendas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Desayunos y Meriendas',
                'slug' => 'desayunos-y-meriendas',
                'descripcion' => 'Categoría de Desayunos y Meriendas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'empanadas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Empanadas',
                'slug' => 'empanadas',
                'descripcion' => 'Categoría de Empanadas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'helados')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Helados',
                'slug' => 'helados',
                'descripcion' => 'Categoría de Helados',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sandwiches')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Sandwiches',
                'slug' => 'sandwiches',
                'descripcion' => 'Categoría de Sandwiches',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tablas-de-pasapalos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Tablas de Pasapalos',
                'slug' => 'tablas-de-pasapalos',
                'descripcion' => 'Categoría de Tablas de Pasapalos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tartas-saladas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Tartas Saladas',
                'slug' => 'tartas-saladas',
                'descripcion' => 'Categoría de Tartas Saladas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tortas-y-tartas-dulces')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Tortas y Tartas Dulces',
                'slug' => 'tortas-y-tartas-dulces',
                'descripcion' => 'Categoría de Tortas y Tartas Dulces',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-comida-preparada')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Otros',
                'slug' => 'otros-comida-preparada',
                'descripcion' => 'Categoría de Otros',
            ]);
        };








        //--------------------Belleza y Cuidado Personal-------------------------------
        //--------------------Artículos y Accesorios-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-de-bano')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Accesorios de Baño',
                'slug' => 'accesorios-de-bano',
                'descripcion' => 'Categoría de Accesorios de Baño',
            ]);
        };

        $categoria = MainCategory::where('slug', 'aparatos-y-utensilios-de-peinado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Aparatos y Utensilios de Peinado',
                'slug' => 'aparatos-y-utensilios-de-peinado',
                'descripcion' => 'Categoría de Aparatos y Utensilios de Peinado',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bolitas-e-hisopos-de-algodon')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Bolitas e Hisopos de Algodón',
                'slug' => 'bolitas-e-hisopos-de-algodon',
                'descripcion' => 'Categoría de Bolitas e Hisopos de Algodón',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bolsas-y-estuches')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Bolsas y Estuches',
                'slug' => 'bolsas-y-estuches',
                'descripcion' => 'Categoría de Bolsas y Estuches',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calefactores-y-calentadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Calefactores y Calentadores',
                'slug' => 'calefactores-y-calentadores',
                'descripcion' => 'Categoría de Calefactores y Calentadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cepillos-y-utensilios-de-maquillaje')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Cepillos y Utensilios de Maquillaje',
                'slug' => 'cepillos-y-utensilios-de-maquillaje',
                'descripcion' => 'Categoría de Cepillos y Utensilios de Maquillaje',
            ]);
        };

        $categoria = MainCategory::where('slug', 'equipo-de-spa-y-salon')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Equipo de Spa y Salón',
                'slug' => 'equipo-de-spa-y-salon',
                'descripcion' => 'Categoría de Equipo de Spa y Salón',
            ]);
        };

        $categoria = MainCategory::where('slug', 'espejos-articulos-belleza')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Espejos',
                'slug' => 'espejos-articulos-belleza',
                'descripcion' => 'Categoría de Espejos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-para-cuidado-de-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Instrumentos para Cuidado de Piel',
                'slug' => 'instrumentos-para-cuidado-de-piel',
                'descripcion' => 'Categoría de Instrumentos para Cuidado de Piel',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-para-peinado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Instrumentos para Peinado',
                'slug' => 'instrumentos-para-peinado',
                'descripcion' => 'Categoría de Instrumentos para Peinado',
            ]);
        };




        //--------------------Afeitado y Depilación-------------------------------
        $categoria = MainCategory::where('slug', 'hombres-afeitado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '46',
                'nombre' => 'Hombres',
                'slug' => 'hombres-afeitado',
                'descripcion' => 'Categoría de Hombres',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mujeres-afeitado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '46',
                'nombre' => 'Mujeres',
                'slug' => 'mujeres-afeitado',
                'descripcion' => 'Categoría de Mujeres',
            ]);
        };






        //--------------------Cosméticos-------------------------------
        $categoria = MainCategory::where('slug', 'bases-y-polvos-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Bases y Polvos',
                'slug' => 'bases-y-polvos-cosmeticos',
                'descripcion' => 'Categoría de Bases y Polvos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'brochas-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Brochas',
                'slug' => 'brochas-cosmeticos',
                'descripcion' => 'Categoría de Brochas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'correctores-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Correctores',
                'slug' => 'correctores-cosmeticos',
                'descripcion' => 'Categoría de Correctores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'desmaquillantes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Desmaquillantes',
                'slug' => 'desmaquillantes',
                'descripcion' => 'Categoría de Desmaquillantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'hidratantes-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Hidratantes',
                'slug' => 'hidratantes-cosmeticos',
                'descripcion' => 'Categoría de Hidratantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'labiales-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Labiales',
                'slug' => 'labiales-cosmeticos',
                'descripcion' => 'Categoría de Labiales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'paletas-de-sombras-contornos-iluminadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Paletas de Sombras, Contornos e Iluminadores',
                'slug' => 'paletas-de-sombras-contornos-iluminadores',
                'descripcion' => 'Categoría de Paletas de Sombras, Contornos e Iluminadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'primer-cosmetico')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Primer',
                'slug' => 'primer-cosmetico',
                'descripcion' => 'Categoría de Primer',
            ]);
        };



        //--------------------Cuidado Bucal-------------------------------
        $categoria = MainCategory::where('slug', 'articulos-de-ortodoncia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Artículos de Ortodoncia',
                'slug' => 'articulos-de-ortodoncia',
                'descripcion' => 'Categoría de Artículos de Ortodoncia',
            ]);
        };

        $categoria = MainCategory::where('slug', 'blanqueadores-dentales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Blanqueadores Dentales',
                'slug' => 'blanqueadores-dentales',
                'descripcion' => 'Categoría de Blanqueadores Dentales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cepillos-de-dientes-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Cepillos de Dientes y Accesorios',
                'slug' => 'cepillos-de-dientes-y-accesorios',
                'descripcion' => 'Categoría de Cepillos de Dientes y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-de-dentaduras-postizas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Cuidado de Dentaduras Postizas',
                'slug' => 'cuidado-de-dentaduras-postizas',
                'descripcion' => 'Categoría de Cuidado de Dentaduras Postizas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-dental-para-ninos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Cuidado Dental para Niños',
                'slug' => 'cuidado-dental-para-ninos',
                'descripcion' => 'Categoría de Cuidado Dental para Niños',
            ]);
        };

        $categoria = MainCategory::where('slug', 'enjuagues-bucales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Enjuagues Bucales',
                'slug' => 'enjuagues-bucales',
                'descripcion' => 'Categoría de Enjuagues Bucales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'hilo-dental-y-palillos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Hilo Dental y Palillos',
                'slug' => 'hilo-dental-y-palillos',
                'descripcion' => 'Categoría de Hilo Dental y Palillos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'limpiadores-de-lengua')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Limpiadores de Lengua',
                'slug' => 'limpiadores-de-lengua',
                'descripcion' => 'Categoría de Limpiadores de Lengua',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pastas-de-dientes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Pastas de Dientes',
                'slug' => 'pastas-de-dientes',
                'descripcion' => 'Categoría de Pastas de Dientes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'refrescantes-de-aliento')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Refrescantes de Aliento',
                'slug' => 'refrescantes-de-aliento',
                'descripcion' => 'Categoría de Refrescantes de Aliento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tratamientos-para-sensibilidad')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Tratamientos para Sensibilidad',
                'slug' => 'tratamientos-para-sensibilidad',
                'descripcion' => 'Categoría de Tratamientos para Sensibilidad',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-bucal')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-bucal',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Cuidado Personal-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-de-bano')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Accesorios de Baño',
                'slug' => 'accesorios-de-bano',
                'descripcion' => 'Categoría de Accesorios de Baño',
            ]);
        };

        $categoria = MainCategory::where('slug', 'articulos-de-higiene-personal')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Artículos de Higiene Personal',
                'slug' => 'articulos-de-higiene-personal',
                'descripcion' => 'Categoría de Artículos de Higiene Personal',
            ]);
        };

        $categoria = MainCategory::where('slug', 'articulos-para-piercing-y-tatuajes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Artículos para Piercing y Tatuajes',
                'slug' => 'articulos-para-piercing-y-tatuajes',
                'descripcion' => 'Categoría de Artículos para Piercing y Tatuajes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-para-labios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Cuidado para Labios',
                'slug' => 'cuidado-para-labios',
                'descripcion' => 'Categoría de Cuidado para Labios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'desodorantes-y-antitranspirantes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Desodorantes y Antitranspirantes',
                'slug' => 'desodorantes-y-antitranspirantes',
                'descripcion' => 'Categoría de Desodorantes y Antitranspirantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-personal')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-personal',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Cuidado del Cabello-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-para-peinarse')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Accesorios para Peinarse',
                'slug' => 'accesorios-para-peinarse',
                'descripcion' => 'Categoría de Accesorios para Peinarse',
            ]);
        };

        $categoria = MainCategory::where('slug', 'aceites-para-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Aceites para Cabello',
                'slug' => 'aceites-para-cabello',
                'descripcion' => 'Categoría de Aceites para Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'aparatos-y-utensilios-de-peinado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Aparatos y Utensilios de Peinado',
                'slug' => 'aparatos-y-utensilios-de-peinado',
                'descripcion' => 'Categoría de Aparatos y Utensilios de Peinado',
            ]);
        };

        $categoria = MainCategory::where('slug', 'caida-de-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Caída de Cabello',
                'slug' => 'caida-de-cabello',
                'descripcion' => 'Categoría de Caída de Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'champu-y-acondicionador')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Champú y Acondicionador',
                'slug' => 'champu-y-acondicionador',
                'descripcion' => 'Categoría de Champú y Acondicionador',
            ]);
        };

        $categoria = MainCategory::where('slug', 'extensiones-pelucas-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Extensiones, Pelucas y Accesorios',
                'slug' => 'extensiones-pelucas-y-accesorios',
                'descripcion' => 'Categoría de Extensiones, Pelucas y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mascarillas-para-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Mascarillas para Cabello',
                'slug' => 'mascarillas-para-cabello',
                'descripcion' => 'Categoría de Mascarillas para Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'permanentes-relajantes-y-texturizadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Permanentes, Relajantes y Texturizadores',
                'slug' => 'permanentes-relajantes-y-texturizadores',
                'descripcion' => 'Categoría de Permanentes, Relajantes y Texturizadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'productos-para-peinar')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Productos para Peinar',
                'slug' => 'productos-para-peinar',
                'descripcion' => 'Categoría de Productos para Peinar',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tintes-para-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Tintes para Cabello',
                'slug' => 'tintes-para-cabello',
                'descripcion' => 'Categoría de Tintes para Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'utensillos-para-cortar-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Utensillos para Cortar Cabello',
                'slug' => 'utensillos-para-cortar-cabello',
                'descripcion' => 'Categoría de Utensillos para Cortar Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-cabello',
                'descripcion' => 'Categoría de Otros',
            ]);
        };





        //--------------------Cuidado de la Piel-------------------------------
        $categoria = MainCategory::where('slug', 'cuerpo-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Cuerpo',
                'slug' => 'cuerpo-cuidado-piel',
                'descripcion' => 'Categoría de Cuerpo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juegos-y-kits')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Juegos y Kits',
                'slug' => 'juegos-y-kits',
                'descripcion' => 'Categoría de Juegos y Kits',
            ]);
        };

        $categoria = MainCategory::where('slug', 'maternidad-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Maternidad',
                'slug' => 'maternidad-cuidado-piel',
                'descripcion' => 'Categoría de Maternidad',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ojos-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Ojos',
                'slug' => 'ojos-cuidado-piel',
                'descripcion' => 'Categoría de Ojos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'protectores-solares-y-bronceadores-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Protectores Solares y Bronceadores',
                'slug' => 'protectores-solares-y-bronceadores-cuidado-piel',
                'descripcion' => 'Categoría de Protectores Solares y Bronceadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'rostro-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Rostro',
                'slug' => 'rostro-cuidado-piel',
                'descripcion' => 'Categoría de Rostro',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-piel',
                'descripcion' => 'Categoría de Otros',
            ]);
        };



        //--------------------Cuidado de Pies, Manos y Uñas-------------------------------
        $categoria = MainCategory::where('slug', 'cuidado-de-pies-y-manos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Cuidado de Pies y Manos',
                'slug' => 'cuidado-de-pies-y-manos',
                'descripcion' => 'Categoría de Cuidado de Pies y Manos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'esmalte-y-decoracion-de-unas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Esmalte y Decoración de Uñas',
                'slug' => 'esmalte-y-decoracion-de-unas',
                'descripcion' => 'Categoría de Esmalte y Decoración de Uñas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tratamientos-para-unas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Tratamientos para Uñas',
                'slug' => 'tratamientos-para-unas',
                'descripcion' => 'Categoría de Tratamientos para Uñas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'utensilios-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Utensilios y Accesorios',
                'slug' => 'utensilios-y-accesorios',
                'descripcion' => 'Categoría de Utensilios y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-pies-manos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-pies-manos',
                'descripcion' => 'Categoría de Otros',
            ]);
        };




        //--------------------Fragancia-------------------------------
        $categoria = MainCategory::where('slug', 'combos-juegos-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Combos, Juegos',
                'slug' => 'combos-juegos-fragancias',
                'descripcion' => 'Categoría de Combos, Juegos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'hombres-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Hombres',
                'slug' => 'hombres-fragancias',
                'descripcion' => 'Categoría de Hombres',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mujeres-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Mujeres',
                'slug' => 'mujeres-fragancias',
                'descripcion' => 'Categoría de Mujeres',
            ]);
        };
        
        $categoria = MainCategory::where('slug', 'ninos-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Niños',
                'slug' => 'ninos-fragancias',
                'descripcion' => 'Categoría de Niños',
            ]);
        };

        $categoria = MainCategory::where('slug', 'talcos-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Talcos',
                'slug' => 'talcos-fragancias',
                'descripcion' => 'Categoría de Talcos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Otros',
                'slug' => 'otros-fragancias',
                'descripcion' => 'Categoría de Otros',
            ]);
        };












        // --------------- Nuevos Agreados ----------------------

        // Cosméticos
        $categoria = MainCategory::where('slug', 'rimel-mascarilla-cosmetico')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Rimel / Mascarilla',
                'slug' => 'rimel-mascarilla-cosmetico',
                'descripcion' => 'Categoría de Rimel / Mascarilla',
            ]);
        };

        $categoria = MainCategory::where('slug', 'rubor-cosmetico')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Rubor',
                'slug' => 'rubor-cosmetico',
                'descripcion' => 'Categoría de Rubor',
            ]);
        };
        
        $categoria = MainCategory::where('slug', 'otros-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Otros',
                'slug' => 'otros-cosmeticos',
                'descripcion' => 'Categoría de Otros',
            ]);
        };




        
    }
}
