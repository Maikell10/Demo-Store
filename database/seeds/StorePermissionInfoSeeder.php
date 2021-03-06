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
                'descripcion' => 'Categor??a de Ropa, Zapatos y Joyas',
            ]);
        };

        $categoria = Category::where('slug', 'libros')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Libros',
                'slug' => 'libros',
                'descripcion' => 'Categor??a de Libros',
            ]);
        };

        $categoria = Category::where('slug', 'peliculas-musica-y-juegos')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Pel??culas, M??sica y Juegos',
                'slug' => 'peliculas-musica-y-juegos',
                'descripcion' => 'Categor??a de Pel??culas, M??sica y Juegos',
            ]);
        };

        $categoria = Category::where('slug', 'electronicos')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Electr??nicos',
                'slug' => 'electronicos',
                'descripcion' => 'Categor??a de Aparatos Electr??nicos',
            ]);
        };

        $categoria = Category::where('slug', 'computadoras')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Computadoras',
                'slug' => 'computadoras',
                'descripcion' => 'Categor??a de Computadoras',
            ]);
        };

        $categoria = Category::where('slug', 'computadoras')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Computadoras',
                'slug' => 'computadoras',
                'descripcion' => 'Categor??a de Computadoras',
            ]);
        };

        $categoria = Category::where('slug', 'automotriz')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Automotriz',
                'slug' => 'automotriz',
                'descripcion' => 'Categor??a de Automotriz',
            ]);
        };

        $categoria = Category::where('slug', 'alimentos-y-bebidas')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Alimentos y Bebidas',
                'slug' => 'alimentos-y-bebidas',
                'descripcion' => 'Categor??a de Alimentos y Bebidas',
            ]);
        };

        $categoria = Category::where('slug', 'belleza-y-cuidado-personal')->first();
        if (!$categoria) {
            $categoria = Category::create([
                'nombre' => 'Belleza y Cuidado Personal',
                'slug' => 'belleza-y-cuidado-personal',
                'descripcion' => 'Categor??a de Belleza y Cuidado Personal',
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
                'descripcion' => 'Categor??a de Hombres',
            ]);
        };

        $categoria = SubCategory::where('slug', 'mujeres')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '1',
                'nombre' => 'Mujeres',
                'slug' => 'mujeres',
                'descripcion' => 'Categor??a de Mujeres',
            ]);
        };

        $categoria = SubCategory::where('slug', 'ninos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '1',
                'nombre' => 'Ni??os',
                'slug' => 'ninos',
                'descripcion' => 'Categor??a de Ni??os',
            ]);
        };

        $categoria = SubCategory::where('slug', 'ninas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '1',
                'nombre' => 'Ni??as',
                'slug' => 'ninas',
                'descripcion' => 'Categor??a de Ni??as',
            ]);
        };

        $categoria = SubCategory::where('slug', 'bebes')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '1',
                'nombre' => 'Beb??s',
                'slug' => 'bebes',
                'descripcion' => 'Categor??a de Beb??s',
            ]);
        };


        //--------------------LIBROS-------------------------------
        $categoria = SubCategory::where('slug', 'libros')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '2',
                'nombre' => 'Libros',
                'slug' => 'libros',
                'descripcion' => 'Categor??a de Libros',
            ]);
        };


        //--------------------Pel??culas, M??sica y Juegos-------------------------------
        $categoria = SubCategory::where('slug', 'cine-y-tv')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '3',
                'nombre' => 'Cine y TV',
                'slug' => 'cine-y-tv',
                'descripcion' => 'Categor??a de Cine y TV',
            ]);
        };

        $categoria = SubCategory::where('slug', 'instrumentos-musicales')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '3',
                'nombre' => 'Instrumentos Musicales',
                'slug' => 'instrumentos-musicales',
                'descripcion' => 'Categor??a de Instrumentos Musicales',
            ]);
        };

        $categoria = SubCategory::where('slug', 'musica')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '3',
                'nombre' => 'M??sica',
                'slug' => 'musica',
                'descripcion' => 'Categor??a de M??sica',
            ]);
        };

        $categoria = SubCategory::where('slug', 'videojuegos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '3',
                'nombre' => 'Videojuegos',
                'slug' => 'videojuegos',
                'descripcion' => 'Categor??a de Videojuegos',
            ]);
        };


        //--------------------ELECTRONICOS-------------------------------
        $categoria = SubCategory::where('slug', 'accesorios-y-suministros')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Accesorios y Suministros',
                'slug' => 'accesorios-y-suministros',
                'descripcion' => 'Categor??a de Accesorios y Suministros',
            ]);
        };

        $categoria = SubCategory::where('slug', 'audifonos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Aud??fonos',
                'slug' => 'audifonos',
                'descripcion' => 'Categor??a de Aud??fonos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'audio-para-el-hogar')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Audio para el Hogar',
                'slug' => 'audio-para-el-hogar',
                'descripcion' => 'Categor??a de Audio para el Hogar',
            ]);
        };

        $categoria = SubCategory::where('slug', 'camaras-y-fotografia')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'C??maras y Fotograf??a',
                'slug' => 'camaras-y-fotografia',
                'descripcion' => 'Categor??a de C??maras y Fotograf??a',
            ]);
        };

        $categoria = SubCategory::where('slug', 'consolas-y-accesorios-para-videojuegos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Consolas y Accesorios para Videojuegos',
                'slug' => 'consolas-y-accesorios-para-videojuegos',
                'descripcion' => 'Categor??a de Consolas y Accesorios para Videojuegos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'electronica-para-autos-y-vehiculos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Electr??nica para Autos y Veh??culos',
                'slug' => 'electronica-para-autos-y-vehiculos',
                'descripcion' => 'Categor??a de Electr??nica para Autos y Veh??culos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'electronicos-de-oficina')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Electr??nicos de Oficina',
                'slug' => 'electronicos-de-oficina',
                'descripcion' => 'Categor??a de Electr??nicos de Oficina',
            ]);
        };

        $categoria = SubCategory::where('slug', 'navegacion-satelital-y-gps')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Navegaci??n Satelital y GPS',
                'slug' => 'navegacion-satelital-y-gps',
                'descripcion' => 'Categor??a de Navegaci??n Satelital y GPS',
            ]);
        };

        $categoria = SubCategory::where('slug', 'tecnologia-vestible')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Tecnolog??a Vestible',
                'slug' => 'tecnologia-vestible',
                'descripcion' => 'Categor??a de Tecnolog??a Vestible',
            ]);
        };

        $categoria = SubCategory::where('slug', 'telefonos-celulares-y-accesorios')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Tel??fonos Celulares y Accesorios',
                'slug' => 'telefonos-celulares-y-accesorios',
                'descripcion' => 'Categor??a de Tel??fonos Celulares y Accesorios',
            ]);
        };

        $categoria = SubCategory::where('slug', 'television-y-video')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Televisi??n y V??deo',
                'slug' => 'television-y-video',
                'descripcion' => 'Categor??a de Televisi??n y V??deo',
            ]);
        };


        $categoria = SubCategory::where('slug', 'tecnologia-vestible')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Tecnolog??a Vestible',
                'slug' => 'tecnologia-vestible',
                'descripcion' => 'Categor??a de Tecnolog??a Vestible',
            ]);
        };

        $categoria = SubCategory::where('slug', 'seguridad-y-vigilancia')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '4',
                'nombre' => 'Seguridad y Vigilancia',
                'slug' => 'seguridad-y-vigilancia',
                'descripcion' => 'Categor??a de Seguridad y Vigilancia',
            ]);
        };


        //--------------------COMPUTADORAS-------------------------------
        $categoria = SubCategory::where('slug', 'accesorios-para-computadora')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Accesorios para Computadora',
                'slug' => 'accesorios-para-computadora',
                'descripcion' => 'Categor??a de Accesorios para Computadora',
            ]);
        };

        $categoria = SubCategory::where('slug', 'accesorios-para-tablets')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Accesorios para Tablets',
                'slug' => 'accesorios-para-tablets',
                'descripcion' => 'Categor??a de Accesorios para Tablets',
            ]);
        };

        $categoria = SubCategory::where('slug', 'almacenamiento-externo-de-datos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Almacenamiento Externo de Datos',
                'slug' => 'almacenamiento-externo-de-datos',
                'descripcion' => 'Categor??a de Almacenamiento Externo de Datos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'componentes-de-computadoras')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Componentes de Computadoras',
                'slug' => 'componentes-de-computadoras',
                'descripcion' => 'Categor??a de Componentes de Computadoras',
            ]);
        };

        $categoria = SubCategory::where('slug', 'computadoras-y-tablets')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Computadoras y Tablets',
                'slug' => 'computadoras-y-tablets',
                'descripcion' => 'Categor??a de Computadoras y Tablets',
            ]);
        };

        $categoria = SubCategory::where('slug', 'escaneres')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Esc??neres',
                'slug' => 'escaneres',
                'descripcion' => 'Categor??a de Esc??neres',
            ]);
        };

        $categoria = SubCategory::where('slug', 'impresoras')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Impresoras',
                'slug' => 'impresoras',
                'descripcion' => 'Categor??a de Impresoras',
            ]);
        };

        $categoria = SubCategory::where('slug', 'monitores')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '5',
                'nombre' => 'Monitores',
                'slug' => 'monitores',
                'descripcion' => 'Categor??a de Monitores',
            ]);
        };


        //--------------------AUTOMOTRIZ-------------------------------
        $categoria = SubCategory::where('slug', 'accesorios-exteriores')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Accesorios Exteriores',
                'slug' => 'accesorios-exteriores',
                'descripcion' => 'Categor??a de Accesorios Exteriores',
            ]);
        };

        $categoria = SubCategory::where('slug', 'accesorios-interiores')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Accesorios Interiores',
                'slug' => 'accesorios-interiores',
                'descripcion' => 'Categor??a de Accesorios Interiores',
            ]);
        };

        $categoria = SubCategory::where('slug', 'aceites-y-fluidos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Aceites y Fluidos',
                'slug' => 'aceites-y-fluidos',
                'descripcion' => 'Categor??a de Aceites y Fluidos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-automotriz')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Cuidado Automotriz',
                'slug' => 'cuidado-automotriz',
                'descripcion' => 'Categor??a de Cuidado Automotriz',
            ]);
        };

        $categoria = SubCategory::where('slug', 'herramientas-y-equipos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Herramientas y Equipos',
                'slug' => 'herramientas-y-equipos',
                'descripcion' => 'Categor??a de Herramientas y Equipos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'luces-y-accesorios-de-iluminacion')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Luces y Accesorios de Iluminaci??n',
                'slug' => 'luces-y-accesorios-de-iluminacion',
                'descripcion' => 'Categor??a de Luces y Accesorios de Iluminaci??n',
            ]);
        };

        $categoria = SubCategory::where('slug', 'motos-accesorios-y-piezas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Motos, Accesorios y Piezas',
                'slug' => 'motos-accesorios-y-piezas',
                'descripcion' => 'Categor??a de Motos, Accesorios y Piezas',
            ]);
        };

        $categoria = SubCategory::where('slug', 'neumaticos-y-ruedas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Neum??ticos y Ruedas',
                'slug' => 'neumaticos-y-ruedas',
                'descripcion' => 'Categor??a de Neum??ticos y Ruedas',
            ]);
        };

        $categoria = SubCategory::where('slug', 'pintura-y-suministros-de-pintura')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Pintura y Suministros de Pintura',
                'slug' => 'pintura-y-suministros-de-pintura',
                'descripcion' => 'Categor??a de Pintura y Suministros de Pintura',
            ]);
        };

        $categoria = SubCategory::where('slug', 'repuestos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Repuestos',
                'slug' => 'repuestos',
                'descripcion' => 'Categor??a de Repuestos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'sonido')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '6',
                'nombre' => 'Sonido',
                'slug' => 'sonido',
                'descripcion' => 'Categor??a de Sonido',
            ]);
        };


        //--------------------Alimentos y Bebidas-------------------------------
        $categoria = SubCategory::where('slug', 'bebidas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '7',
                'nombre' => 'Bebidas',
                'slug' => 'bebidas',
                'descripcion' => 'Categor??a de Bebidas',
            ]);
        };

        $categoria = SubCategory::where('slug', 'comestibles')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '7',
                'nombre' => 'Comestibles',
                'slug' => 'comestibles',
                'descripcion' => 'Categor??a de Comestibles',
            ]);
        };

        $categoria = SubCategory::where('slug', 'comida-preparada')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '7',
                'nombre' => 'Comida Preparada',
                'slug' => 'comida-preparada',
                'descripcion' => 'Categor??a de Comida Preparada',
            ]);
        };
        

        //--------------------Belleza y Cuidado Personal-------------------------------
        $categoria = SubCategory::where('slug', 'articulos-y-accesorios')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Art??culos y Accesorios',
                'slug' => 'articulos-y-accesorios',
                'descripcion' => 'Categor??a de Art??culos y Accesorios',
            ]);
        };

        $categoria = SubCategory::where('slug', 'afeitado-y-depilacion')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Afeitado y Depilaci??n',
                'slug' => 'afeitado-y-depilacion',
                'descripcion' => 'Categor??a de Afeitado y Depilaci??n',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cosmeticos')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cosm??ticos',
                'slug' => 'cosmeticos',
                'descripcion' => 'Categor??a de Cosm??ticos',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-bucal')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado Bucal',
                'slug' => 'cuidado-bucal',
                'descripcion' => 'Categor??a de Cuidado Bucal',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-personal')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado Personal',
                'slug' => 'cuidado-personal',
                'descripcion' => 'Categor??a de Cuidado Personal',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-del-cabello')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado del Cabello',
                'slug' => 'cuidado-del-cabello',
                'descripcion' => 'Categor??a de Cuidado del Cabello',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-de-la-piel')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado de la Piel',
                'slug' => 'cuidado-de-la-piel',
                'descripcion' => 'Categor??a de Cuidado de la Piel',
            ]);
        };

        $categoria = SubCategory::where('slug', 'cuidado-de-pies-manos-y-unas')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Cuidado de Pies, Manos y U??as',
                'slug' => 'cuidado-de-pies-manos-y-unas',
                'descripcion' => 'Categor??a de Cuidado de Pies, Manos y U??as',
            ]);
        };

        $categoria = SubCategory::where('slug', 'fragancia')->first();
        if (!$categoria) {
            $categoria = SubCategory::create([
                'category_id' => '8',
                'nombre' => 'Fragancia',
                'slug' => 'fragancia',
                'descripcion' => 'Categor??a de Fragancia',
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
                'descripcion' => 'Categor??a de Accesorios de Hombre',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calzado-hombre')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '1',
                'nombre' => 'Calzado',
                'slug' => 'calzado-hombre',
                'descripcion' => 'Categor??a de Calzado de Hombre',
            ]);
        };

        $categoria = MainCategory::where('slug', 'relojes-hombre')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '1',
                'nombre' => 'Relojes',
                'slug' => 'relojes-hombre',
                'descripcion' => 'Categor??a de Relojes de Hombre',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-hombre')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '1',
                'nombre' => 'Ropa',
                'slug' => 'ropa-hombre',
                'descripcion' => 'Categor??a de Ropa de Hombre',
            ]);
        };


        //--------------------Mujeres-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-mujer',
                'descripcion' => 'Categor??a de Accesorios de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bolsos-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Bolsos',
                'slug' => 'bolsos-mujer',
                'descripcion' => 'Categor??a de Bolsos de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calzado-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Calzado',
                'slug' => 'calzado-mujer',
                'descripcion' => 'Categor??a de Calzado de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'joyeria-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Joyer??a',
                'slug' => 'joyeria-mujer',
                'descripcion' => 'Categor??a de Joyer??a de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'relojes-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Relojes',
                'slug' => 'relojes-mujer',
                'descripcion' => 'Categor??a de Relojes de Mujer',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-mujer')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '2',
                'nombre' => 'Ropa',
                'slug' => 'ropa-mujer',
                'descripcion' => 'Categor??a de Ropa de Mujer',
            ]);
        };


        //--------------------Ni??os-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-nino')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '3',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-nino',
                'descripcion' => 'Categor??a de Accesorios de Ni??o',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calzado-nino')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '3',
                'nombre' => 'Calzado',
                'slug' => 'calzado-nino',
                'descripcion' => 'Categor??a de Calzado de Ni??o',
            ]);
        };

        $categoria = MainCategory::where('slug', 'relojes-nino')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '3',
                'nombre' => 'Relojes',
                'slug' => 'relojes-nino',
                'descripcion' => 'Categor??a de Relojes de Ni??o',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-nino')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '3',
                'nombre' => 'Ropa',
                'slug' => 'ropa-nino',
                'descripcion' => 'Categor??a de Ropa de Ni??o',
            ]);
        };


        //--------------------Ni??as-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-nina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '4',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-nina',
                'descripcion' => 'Categor??a de Accesorios de Ni??a',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calzado-nina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '4',
                'nombre' => 'Calzado',
                'slug' => 'calzado-nina',
                'descripcion' => 'Categor??a de Calzado de Ni??a',
            ]);
        };

        $categoria = MainCategory::where('slug', 'relojes-nina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '4',
                'nombre' => 'Relojes',
                'slug' => 'relojes-nina',
                'descripcion' => 'Categor??a de Relojes de Ni??a',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-nina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '4',
                'nombre' => 'Ropa',
                'slug' => 'ropa-nina',
                'descripcion' => 'Categor??a de Ropa de Ni??a',
            ]);
        };

        //--------------------Bebes-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-bebe',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'actividad-y-entretenimiento-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Actividad y Entretenimiento',
                'slug' => 'actividad-y-entretenimiento-bebe',
                'descripcion' => 'Categor??a de Actividad y Entretenimiento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'alimentacion-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Alimentaci??n',
                'slug' => 'alimentacion-bebe',
                'descripcion' => 'Categor??a de Alimentaci??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-de-bebes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Cuidado de Beb??s',
                'slug' => 'cuidado-de-bebes',
                'descripcion' => 'Categor??a de Cuidado de Beb??s',
            ]);
        };

        $categoria = MainCategory::where('slug', 'embarazo-y-maternidad')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Embarazo y Maternidad',
                'slug' => 'embarazo-y-maternidad',
                'descripcion' => 'Categor??a de Embarazo y Maternidad',
            ]);
        };

        $categoria = MainCategory::where('slug', 'habitacion-de-bebes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Habitaci??n de Beb??s',
                'slug' => 'habitacion-de-bebes',
                'descripcion' => 'Categor??a de Habitaci??n de Beb??s',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juguetes-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Juguetes',
                'slug' => 'juguetes-bebe',
                'descripcion' => 'Categor??a de Juguetes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'panales-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Pa??ales',
                'slug' => 'panales-bebe',
                'descripcion' => 'Categor??a de Pa??ales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-bebe')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '5',
                'nombre' => 'Ropa',
                'slug' => 'ropa-bebe',
                'descripcion' => 'Categor??a de Ropa de Beb??s',
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
                'descripcion' => 'Categor??a de Audiolibros',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ebooks')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '6',
                'nombre' => 'eBooks',
                'slug' => 'ebooks',
                'descripcion' => 'Categor??a de eBooks',
            ]);
        };

        $categoria = MainCategory::where('slug', 'libros')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '6',
                'nombre' => 'Libros',
                'slug' => 'libros',
                'descripcion' => 'Categor??a de Libros',
            ]);
        };










        //--------------------Pel??culas, M??sica y Juegos-------------------------------
        //--------------------Cine y TV-------------------------------
        $categoria = MainCategory::where('slug', 'blu-ray')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '7',
                'nombre' => 'Blu-ray',
                'slug' => 'blu-ray',
                'descripcion' => 'Categor??a de Blu-ray',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dvd')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '7',
                'nombre' => 'DVD',
                'slug' => 'dvd',
                'descripcion' => 'Categor??a de DVD',
            ]);
        };

        $categoria = MainCategory::where('slug', 'peliculas-y-series-digitales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '7',
                'nombre' => 'Pel??culas y Series Digitales',
                'slug' => 'peliculas-y-series-digitales',
                'descripcion' => 'Categor??a de Pel??culas y Series Digitales',
            ]);
        };


        //--------------------Instrumentos Musicales-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-instrumentos-musicales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-instrumentos-musicales',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'amplificadores-y-efectos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Amplificadores y Efectos',
                'slug' => 'amplificadores-y-efectos',
                'descripcion' => 'Categor??a de Amplificadores y Efectos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bajos-instrumentos-musicales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Bajos',
                'slug' => 'bajos-instrumentos-musicales',
                'descripcion' => 'Categor??a de Bajos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'baterias-y-percusion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Bater??as y Percusi??n',
                'slug' => 'baterias-y-percusion',
                'descripcion' => 'Categor??a de Bater??as y Percusi??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dj-y-karaoke')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'DJ y Karaoke',
                'slug' => 'dj-y-karaoke',
                'descripcion' => 'Categor??a de DJ y Karaoke',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estudio-de-grabacion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Estudio de Grabaci??n',
                'slug' => 'estudio-de-grabacion',
                'descripcion' => 'Categor??a de Estudio de Grabaci??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'guitarras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Guitarras',
                'slug' => 'guitarras',
                'descripcion' => 'Categor??a de Guitarras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-de-cuerda')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Instrumentos de Cuerda',
                'slug' => 'instrumentos-de-cuerda',
                'descripcion' => 'Categor??a de Instrumentos de Cuerda',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-de-metal')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Instrumentos de Metal',
                'slug' => 'instrumentos-de-metal',
                'descripcion' => 'Categor??a de Instrumentos de Metal',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-de-viento')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Instrumentos de Viento',
                'slug' => 'instrumentos-de-viento',
                'descripcion' => 'Categor??a de Instrumentos de Viento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'microfonos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Micr??fonos',
                'slug' => 'microfonos',
                'descripcion' => 'Categor??a de Micr??fonos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sonido-en-vivo-y-escenario')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Sonido en Vivo y Escenario',
                'slug' => 'sonido-en-vivo-y-escenario',
                'descripcion' => 'Categor??a de Sonido en Vivo y Escenario',
            ]);
        };

        $categoria = MainCategory::where('slug', 'teclados-y-midi')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Teclados y Midi',
                'slug' => 'teclados-y-midi',
                'descripcion' => 'Categor??a de Teclados y Midi',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ukuleles')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '8',
                'nombre' => 'Ukuleles',
                'slug' => 'ukuleles',
                'descripcion' => 'Categor??a de Ukuleles',
            ]);
        };


        //--------------------M??sica-------------------------------
        $categoria = MainCategory::where('slug', 'cd-y-vinilos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '9',
                'nombre' => 'CD y Vinilos',
                'slug' => 'cd-y-vinilos',
                'descripcion' => 'Categor??a de CD y Vinilos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'musica-digital')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '9',
                'nombre' => 'M??sica Digital',
                'slug' => 'musica-digital',
                'descripcion' => 'Categor??a de M??sica Digital',
            ]);
        };


        //--------------------Videojuegos-------------------------------
        $categoria = MainCategory::where('slug', 'playstation')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'PlayStation',
                'slug' => 'playstation',
                'descripcion' => 'Categor??a de PlayStation',
            ]);
        };

        $categoria = MainCategory::where('slug', 'xbox')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'Xbox',
                'slug' => 'xbox',
                'descripcion' => 'Categor??a de Xbox',
            ]);
        };

        $categoria = MainCategory::where('slug', 'nintendo')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'Nintendo',
                'slug' => 'nintendo',
                'descripcion' => 'Categor??a de Nintendo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'PC',
                'slug' => 'pc',
                'descripcion' => 'Categor??a de PC',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mac-videojuegos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'MAC',
                'slug' => 'mac-videojuegos',
                'descripcion' => 'Categor??a de MAC',
            ]);
        };

        $categoria = MainCategory::where('slug', 'servicios-de-juego-en-linea')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'Servicios de Juego en L??nea',
                'slug' => 'servicios-de-juego-en-linea',
                'descripcion' => 'Categor??a de Servicios de Juego en L??nea',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-videojuegos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '10',
                'nombre' => 'Otros',
                'slug' => 'otros-videojuegos',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };
        








        //--------------------Electr??nicos-------------------------------
        //--------------------Accesorios y Suministros-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-de-audio-en-casa')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios de Audio en Casa',
                'slug' => 'accesorios-de-audio-en-casa',
                'descripcion' => 'Categor??a de Accesorios de Audio en Casa',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-de-celulares')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios de Celulares',
                'slug' => 'accesorios-de-celulares',
                'descripcion' => 'Categor??a de Accesorios de Celulares',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-de-imagen-y-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios de Imagen y Sonido',
                'slug' => 'accesorios-de-imagen-y-sonido',
                'descripcion' => 'Categor??a de Accesorios de Imagen y Sonido',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-de-oficina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios de Oficina',
                'slug' => 'accesorios-de-oficina',
                'descripcion' => 'Categor??a de Accesorios de Oficina',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-electronicos-para-vehiculos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios Electr??nicos para Veh??culo',
                'slug' => 'accesorios-electronicos-para-vehiculos',
                'descripcion' => 'Categor??a de Accesorios Electr??nicos para Veh??culo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-camaras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios para C??maras',
                'slug' => 'accesorios-para-camaras',
                'descripcion' => 'Categor??a de Accesorios para C??maras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-computadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios para Computadoras',
                'slug' => 'accesorios-para-computadoras',
                'descripcion' => 'Categor??a de Accesorios para Computadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-sistema-gps')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios para Sistema GPS',
                'slug' => 'accesorios-para-sistema-gps',
                'descripcion' => 'Categor??a de Accesorios para Sistema GPS',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-televisores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Accesorios para Televisores',
                'slug' => 'accesorios-para-televisores',
                'descripcion' => 'Categor??a de Accesorios para Televisores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'baterias-cargas-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Bater??as, Cargas y Accesorios',
                'slug' => 'baterias-cargas-y-accesorios',
                'descripcion' => 'Categor??a de Bater??as, Cargas y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cables')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Cables',
                'slug' => 'cables',
                'descripcion' => 'Categor??a de Cables',
            ]);
        };

        $categoria = MainCategory::where('slug', 'microfonos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Micr??fonos',
                'slug' => 'microfonos',
                'descripcion' => 'Categor??a de Micr??fonos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'proteccion-de-alimentacion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Protecci??n de Alimentaci??n',
                'slug' => 'proteccion-de-alimentacion',
                'descripcion' => 'Categor??a de Protecci??n de Alimentaci??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'soportes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Soportes',
                'slug' => 'soportes',
                'descripcion' => 'Categor??a de Soportes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-accesorios-y-suministros')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '11',
                'nombre' => 'Otros',
                'slug' => 'otros-accesorios-y-suministros',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };




        //--------------------Aud??fonos-------------------------------
        $categoria = MainCategory::where('slug', 'audifonos-de-diadema')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '12',
                'nombre' => 'Aud??fonos de Diadema',
                'slug' => 'audifonos-de-diadema',
                'descripcion' => 'Categor??a de Aud??fonos de Diadema',
            ]);
        };

        $categoria = MainCategory::where('slug', 'audifonos-in-ear')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '12',
                'nombre' => 'Aud??fonos In Ear',
                'slug' => 'audifonos-in-ear',
                'descripcion' => 'Categor??a de Aud??fonos In Ear',
            ]);
        };




        //--------------------Audio para el Hogar-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-audio-para-el-hogar')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-audio-para-el-hogar',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'audio-inalambrico-y-streaming')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Audio Inal??mbrico y Streaming',
                'slug' => 'audio-inalambrico-y-streaming',
                'descripcion' => 'Categor??a de Audio Inal??mbrico y Streaming',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bocinas-hogar')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Bocinas',
                'slug' => 'bocinas-hogar',
                'descripcion' => 'Categor??a de Bocinas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'home-theater')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Home Theater',
                'slug' => 'home-theater',
                'descripcion' => 'Categor??a de Home Theater',
            ]);
        };

        $categoria = MainCategory::where('slug', 'radios-y-estereos-compactos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '13',
                'nombre' => 'Radios y Est??reos Compactos',
                'slug' => 'radios-y-estereos-compactos',
                'descripcion' => 'Categor??a de Radios y Est??reos Compactos',
            ]);
        };




        //--------------------C??maras y Fotograf??a-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-camaras-y-fotografia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-camaras-y-fotografia',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'binoculares-y-telescopios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Binoculares y Telescopios',
                'slug' => 'binoculares-y-telescopios',
                'descripcion' => 'Categor??a de Binoculares y Telescopios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'camaras-digitales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'C??maras Digitales',
                'slug' => 'camaras-digitales',
                'descripcion' => 'Categor??a de C??maras Digitales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estuches-y-bolsos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Estuches y Bolsos',
                'slug' => 'estuches-y-bolsos',
                'descripcion' => 'Categor??a de Estuches y Bolsos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'flashes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Flashes',
                'slug' => 'flashes',
                'descripcion' => 'Categor??a de Flashes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'fotografia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Fotograf??a',
                'slug' => 'fotografia',
                'descripcion' => 'Categor??a de Fotograf??a',
            ]);
        };

        $categoria = MainCategory::where('slug', 'iluminacion-y-estudio')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Iluminaci??n y Estudio',
                'slug' => 'iluminacion-y-estudio',
                'descripcion' => 'Categor??a de Iluminaci??n y Estudio',
            ]);
        };

        $categoria = MainCategory::where('slug', 'lentes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Lentes',
                'slug' => 'lentes',
                'descripcion' => 'Categor??a de Lentes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tripodes-y-monopies')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Tr??podes y Monopies',
                'slug' => 'tripodes-y-monopies',
                'descripcion' => 'Categor??a de Tr??podes y Monopies',
            ]);
        };

        $categoria = MainCategory::where('slug', 'video')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '14',
                'nombre' => 'Video',
                'slug' => 'video',
                'descripcion' => 'Categor??a de Video',
            ]);
        };




        //--------------------Consolas y Accesorios para Videojuegos-------------------------------
        $categoria = MainCategory::where('slug', 'playstation-consola')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '15',
                'nombre' => 'PlayStation',
                'slug' => 'playstation-consola',
                'descripcion' => 'Categor??a de PlayStation',
            ]);
        };
        
        $categoria = MainCategory::where('slug', 'xbox-consola')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '15',
                'nombre' => 'Xbox',
                'slug' => 'xbox-consola',
                'descripcion' => 'Categor??a de Xbox',
            ]);
        };

        $categoria = MainCategory::where('slug', 'nintendo-consola')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '15',
                'nombre' => 'Nintendo',
                'slug' => 'nintendo-consola',
                'descripcion' => 'Categor??a de Nintendo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-consola')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '15',
                'nombre' => 'Otros',
                'slug' => 'otros-consola',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Electr??nica para Autos y Veh??culos-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-electronicos-para-vehiculos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'Accesorios Electr??nicos para Veh??culos',
                'slug' => 'accesorios-electronicos-para-vehiculos',
                'descripcion' => 'Categor??a de Accesorios Electr??nicos para Veh??culos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'electronica-de-auto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'Electr??nica de Auto',
                'slug' => 'electronica-de-auto',
                'descripcion' => 'Categor??a de Electr??nica de Auto',
            ]);
        };

        $categoria = MainCategory::where('slug', 'electronica-de-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'Electr??nica de Moto',
                'slug' => 'electronica-de-moto',
                'descripcion' => 'Categor??a de Electr??nica de Moto',
            ]);
        };

        $categoria = MainCategory::where('slug', 'electronica-marina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'Electr??nica Marina',
                'slug' => 'electronica-marina',
                'descripcion' => 'Categor??a de Electr??nica Marina',
            ]);
        };

        $categoria = MainCategory::where('slug', 'gps-electronica-vehiculos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '16',
                'nombre' => 'GPS',
                'slug' => 'gps-electronica-vehiculos',
                'descripcion' => 'Categor??a de GPS',
            ]);
        };



        //--------------------Electr??nicos de Oficina-------------------------------
        $categoria = MainCategory::where('slug', 'calculadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Calculadoras',
                'slug' => 'calculadoras',
                'descripcion' => 'Categor??a de Calculadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'copiadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Copiadoras',
                'slug' => 'copiadoras',
                'descripcion' => 'Categor??a de Copiadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'equipo-de-punto-de-venta-pos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Equipo de Punto de Venta (POS)',
                'slug' => 'equipo-de-punto-de-venta-pos',
                'descripcion' => 'Categor??a de Equipo de Punto de Venta (POS)',
            ]);
        };

        $categoria = MainCategory::where('slug', 'escaneres-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Esc??neres y Accesorios',
                'slug' => 'escaneres-y-accesorios',
                'descripcion' => 'Categor??a de Esc??neres y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'faxes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Faxes',
                'slug' => 'faxes',
                'descripcion' => 'Categor??a de Faxes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'impresoras-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Impresoras y Accesorios',
                'slug' => 'impresoras-y-accesorios',
                'descripcion' => 'Categor??a de Impresoras y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'proyectores-de-video-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Proyectores de Video y Accesorios',
                'slug' => 'proyectores-de-video-y-accesorios',
                'descripcion' => 'Categor??a de Proyectores de Video y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-electronicos-oficina')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '17',
                'nombre' => 'Otros',
                'slug' => 'otros-electronicos-oficina',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Navegaci??n Satelital y GPS-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-de-sistema-gps')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '18',
                'nombre' => 'Accesorios de Sistema GPS',
                'slug' => 'accesorios-de-sistema-gps',
                'descripcion' => 'Categor??a de Accesorios de Sistema GPS',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistema-gps')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '18',
                'nombre' => 'Sistema GPS',
                'slug' => 'sistema-gps',
                'descripcion' => 'Categor??a de Sistema GPS',
            ]);
        };




        //--------------------Tecnolog??a Vestible-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-tecnologia-vestible')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-tecnologia-vestible',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'clips-brazo-y-pulseras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Clips, Brazo y Pulseras',
                'slug' => 'clips-brazo-y-pulseras',
                'descripcion' => 'Categor??a de Clips, Brazo y Pulseras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'lentes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Lentes',
                'slug' => 'lentes',
                'descripcion' => 'Categor??a de Lentes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'realidad-virtual')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Realidad Virtual',
                'slug' => 'realidad-virtual',
                'descripcion' => 'Categor??a de Realidad Virtual',
            ]);
        };

        $categoria = MainCategory::where('slug', 'smartwatches')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Smartwatches',
                'slug' => 'smartwatches',
                'descripcion' => 'Categor??a de Smartwatches',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-tecnologia-vestible')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '19',
                'nombre' => 'Otros',
                'slug' => 'otros-tecnologia-vestible',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Tel??fonos Celulares y Accesorios-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-telefonos-celulares')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '20',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-telefonos-celulares',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'celulares-con-contrato')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '20',
                'nombre' => 'Celulares con Contrato',
                'slug' => 'celulares-con-contrato',
                'descripcion' => 'Categor??a de Celulares con Contrato',
            ]);
        };

        $categoria = MainCategory::where('slug', 'celulares-desbloqueados')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '20',
                'nombre' => 'Celulares Desbloqueados',
                'slug' => 'celulares-desbloqueados',
                'descripcion' => 'Categor??a de Celulares Desbloqueados',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estuches-fundas-y-clips')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '20',
                'nombre' => 'Estuches, Fundas y Clips',
                'slug' => 'estuches-fundas-y-clips',
                'descripcion' => 'Categor??a de Estuches, Fundas y Clips',
            ]);
        };







        //--------------------Televisi??n y V??deo-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-tv-video')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-tv-video',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'conversores-tv-video')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Conversores',
                'slug' => 'conversores-tv-video',
                'descripcion' => 'Categor??a de Conversores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dispositivos-para-streaming')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Dispositivos para Streaming',
                'slug' => 'dispositivos-para-streaming',
                'descripcion' => 'Categor??a de Dispositivos para Streaming',
            ]);
        };

        $categoria = MainCategory::where('slug', 'proyectores-tv-video')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Proyectores',
                'slug' => 'proyectores-tv-video',
                'descripcion' => 'Categor??a de Proyectores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'reproductores-y-grabadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Reproductores y Grabadoras',
                'slug' => 'reproductores-y-grabadoras',
                'descripcion' => 'Categor??a de Reproductores y Grabadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistema-de-home-theater')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Sistema de Home Theater',
                'slug' => 'sistema-de-home-theater',
                'descripcion' => 'Categor??a de Sistema de Home Theater',
            ]);
        };

        $categoria = MainCategory::where('slug', 'television-satelital')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Televisi??n Satelital',
                'slug' => 'television-satelital',
                'descripcion' => 'Categor??a de Televisi??n Satelital',
            ]);
        };

        $categoria = MainCategory::where('slug', 'televisiones')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '21',
                'nombre' => 'Televisiones',
                'slug' => 'televisiones',
                'descripcion' => 'Categor??a de Televisiones',
            ]);
        };




        //--------------------Seguridad y Vigilancia-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-seguridad-vigilancia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '22',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-seguridad-vigilancia',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'equipos-seguridad-vigilancia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '22',
                'nombre' => 'Equipos',
                'slug' => 'equipos-seguridad-vigilancia',
                'descripcion' => 'Categor??a de Equipos',
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
                'descripcion' => 'Categor??a de Accesorios de Audio y Video',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-de-impresoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios de Impresoras',
                'slug' => 'accesorios-de-impresoras',
                'descripcion' => 'Categor??a de Accesorios de Impresoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-disco-duro')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Disco Duro',
                'slug' => 'accesorios-para-disco-duro',
                'descripcion' => 'Categor??a de Accesorios para Disco Duro',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-escaneres')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Esc??neres',
                'slug' => 'accesorios-para-escaneres',
                'descripcion' => 'Categor??a de Accesorios para Esc??neres',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-monitor')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Monitor',
                'slug' => 'accesorios-para-monitor',
                'descripcion' => 'Categor??a de Accesorios para Monitor',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-proyector')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Proyector',
                'slug' => 'accesorios-para-proyector',
                'descripcion' => 'Categor??a de Accesorios para Proyector',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-tarjetas-de-memoria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Accesorios para Tarjetas de Memoria',
                'slug' => 'accesorios-para-tarjetas-de-memoria',
                'descripcion' => 'Categor??a de Accesorios para Tarjetas de Memoria',
            ]);
        };

        $categoria = MainCategory::where('slug', 'adaptadores-para-cables')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Adaptadores para Cables',
                'slug' => 'adaptadores-para-cables',
                'descripcion' => 'Categor??a de Adaptadores para Cables',
            ]);
        };

        $categoria = MainCategory::where('slug', 'alimentacion-ininterrumpida-ups')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Alimentaci??n Ininterrumpida (UPS)',
                'slug' => 'alimentacion-ininterrumpida-ups',
                'descripcion' => 'Categor??a de Alimentaci??n Ininterrumpida (UPS)',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bases-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Bases',
                'slug' => 'bases-pc',
                'descripcion' => 'Categor??a de Bases',
            ]);
        };

        $categoria = MainCategory::where('slug', 'baterias-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Bater??as',
                'slug' => 'baterias-pc',
                'descripcion' => 'Categor??a de Bater??as',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cables-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Cables',
                'slug' => 'cables-pc',
                'descripcion' => 'Categor??a de Cables',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cargadores-y-adaptadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Cargadores y Adaptadores',
                'slug' => 'cargadores-y-adaptadores',
                'descripcion' => 'Categor??a de Cargadores y Adaptadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dispositivos-de-entrada')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Dispositivos de Entrada',
                'slug' => 'dispositivos-de-entrada',
                'descripcion' => 'Categor??a de Dispositivos de Entrada',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estantes-y-gabinetes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Estantes y Gabinetes',
                'slug' => 'estantes-y-gabinetes',
                'descripcion' => 'Categor??a de Estantes y Gabinetes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'hardware-de-juego')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Hardware de Juego',
                'slug' => 'hardware-de-juego',
                'descripcion' => 'Categor??a de Hardware de Juego',
            ]);
        };

        $categoria = MainCategory::where('slug', 'limpieza-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Limpieza',
                'slug' => 'limpieza-pc',
                'descripcion' => 'Categor??a de Limpieza',
            ]);
        };

        $categoria = MainCategory::where('slug', 'repuestos-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Repuestos',
                'slug' => 'repuestos-pc',
                'descripcion' => 'Categor??a de Repuestos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tarjetas-de-memoria-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Tarjetas de Memoria',
                'slug' => 'tarjetas-de-memoria-pc',
                'descripcion' => 'Categor??a de Tarjetas de Memoria',
            ]);
        };

        $categoria = MainCategory::where('slug', 'teclados-mouse-y-perifericos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Teclados, Mouse y Perif??ricos',
                'slug' => 'teclados-mouse-y-perifericos',
                'descripcion' => 'Categor??a de Teclados, Mouse y Perif??ricos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tinta-y-toner-para-impresoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'Tinta y T??ner para Impresoras',
                'slug' => 'tinta-y-toner-para-impresoras',
                'descripcion' => 'Categor??a de Tinta y T??ner para Impresoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'usb-dispositivos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '23',
                'nombre' => 'USB Dispositivos',
                'slug' => 'usb-dispositivos',
                'descripcion' => 'Categor??a de USB Dispositivos',
            ]);
        };




        //--------------------Accesorios para Tablets-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-tablets')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-tablets',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cargadores-y-adaptadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Cargadores y Adaptadores',
                'slug' => 'cargadores-y-adaptadores',
                'descripcion' => 'Categor??a de Cargadores y Adaptadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cubiertas-y-estuches')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Cubiertas y Estuches',
                'slug' => 'cubiertas-y-estuches',
                'descripcion' => 'Categor??a de Cubiertas y Estuches',
            ]);
        };

        $categoria = MainCategory::where('slug', 'estuches-para-teclados')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Estuches para Teclados',
                'slug' => 'estuches-para-teclados',
                'descripcion' => 'Categor??a de Estuches para Teclados',
            ]);
        };

        $categoria = MainCategory::where('slug', 'fundas-tablets')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Fundas',
                'slug' => 'fundas-tablets',
                'descripcion' => 'Categor??a de Fundas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pencil-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Pencil',
                'slug' => 'pencil-tablet',
                'descripcion' => 'Categor??a de Pencil',
            ]);
        };

        $categoria = MainCategory::where('slug', 'protectores-de-pantalla-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Protectores de Pantalla',
                'slug' => 'protectores-de-pantalla-tablet',
                'descripcion' => 'Categor??a de Protectores de Pantalla',
            ]);
        };

        $categoria = MainCategory::where('slug', 'repuestos-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Repuestos',
                'slug' => 'repuestos-tablet',
                'descripcion' => 'Categor??a de Repuestos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'soportes-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Soportes',
                'slug' => 'soportes-tablet',
                'descripcion' => 'Categor??a de Soportes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'teclados-tablet')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Teclados',
                'slug' => 'teclados-tablet',
                'descripcion' => 'Categor??a de Teclados',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-tablet-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '24',
                'nombre' => 'Otros',
                'slug' => 'otros-tablet-accesorios',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Almacenamiento Externo de Datos-------------------------------
        $categoria = MainCategory::where('slug', 'discos-duros-externos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Discos Duros Externos',
                'slug' => 'discos-duros-externos',
                'descripcion' => 'Categor??a de Discos Duros Externos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'discos-duros-internos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Discos Duros Internos',
                'slug' => 'discos-duros-internos',
                'descripcion' => 'Categor??a de Discos Duros Internos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'unidades-de-estado-solido-externo')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Unidades de Estado S??lido Externo',
                'slug' => 'unidades-de-estado-solido-externo',
                'descripcion' => 'Categor??a de Unidades de Estado S??lido Externo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'unidades-de-estado-solido-interno')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Unidades de Estado S??lido Interno',
                'slug' => 'unidades-de-estado-solido-interno',
                'descripcion' => 'Categor??a de Unidades de Estado S??lido Interno',
            ]);
        };

        $categoria = MainCategory::where('slug', 'unidades-flash-usb')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Unidades Flash USB',
                'slug' => 'unidades-flash-usb',
                'descripcion' => 'Categor??a de Unidades Flash USB',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-almacenamiento-datos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '25',
                'nombre' => 'Otros',
                'slug' => 'otros-almacenamiento-datos',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Componentes de Computadoras-------------------------------
        $categoria = MainCategory::where('slug', 'componentes-de-laptop')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '26',
                'nombre' => 'Componentes de Laptop',
                'slug' => 'componentes-de-laptop',
                'descripcion' => 'Categor??a de Componentes de Laptop',
            ]);
        };

        $categoria = MainCategory::where('slug', 'componentes-externos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '26',
                'nombre' => 'Componentes Externos',
                'slug' => 'componentes-externos',
                'descripcion' => 'Categor??a de Componentes Externos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'componentes-internos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '26',
                'nombre' => 'Componentes Internos',
                'slug' => 'componentes-internos',
                'descripcion' => 'Categor??a de Componentes Internos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-componentes-pc')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '26',
                'nombre' => 'Otros',
                'slug' => 'otros-componentes-pc',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Computadoras y Tablets-------------------------------
        $categoria = MainCategory::where('slug', 'computadoras-de-escritorio')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '27',
                'nombre' => 'Computadoras de Escritorio',
                'slug' => 'computadoras-de-escritorio',
                'descripcion' => 'Categor??a de Computadoras de Escritorio',
            ]);
        };

        $categoria = MainCategory::where('slug', 'laptops')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '27',
                'nombre' => 'Laptops',
                'slug' => 'laptops',
                'descripcion' => 'Categor??a de Laptops',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tablets')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '27',
                'nombre' => 'Tablets',
                'slug' => 'tablets',
                'descripcion' => 'Categor??a de Tablets',
            ]);
        };



        //--------------------Esc??neres-------------------------------
        $categoria = MainCategory::where('slug', 'escaneres')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '28',
                'nombre' => 'Esc??neres',
                'slug' => 'escaneres',
                'descripcion' => 'Categor??a de Esc??neres',
            ]);
        };




        //--------------------Impresoras-------------------------------
        $categoria = MainCategory::where('slug', 'impresoras-de-fotografias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '29',
                'nombre' => 'Impresoras de Fotograf??as',
                'slug' => 'impresoras-de-fotografias',
                'descripcion' => 'Categor??a de Impresoras de Fotograf??as',
            ]);
        };

        $categoria = MainCategory::where('slug', 'impresoras-de-inyeccion-de-tinta')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '29',
                'nombre' => 'Impresoras de Inyecci??n de Tinta',
                'slug' => 'impresoras-de-inyeccion-de-tinta',
                'descripcion' => 'Categor??a de Impresoras de Inyecci??n de Tinta',
            ]);
        };

        $categoria = MainCategory::where('slug', 'impresoras-laser')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '29',
                'nombre' => 'Impresoras L??ser',
                'slug' => 'impresoras-laser',
                'descripcion' => 'Categor??a de Impresoras L??ser',
            ]);
        };

        $categoria = MainCategory::where('slug', 'impresoras-multifuncionales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '29',
                'nombre' => 'Impresoras Multifuncionales',
                'slug' => 'impresoras-multifuncionales',
                'descripcion' => 'Categor??a de Impresoras Multifuncionales',
            ]);
        };





        //--------------------Monitores-------------------------------
        $categoria = MainCategory::where('slug', 'monitores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '30',
                'nombre' => 'Monitores',
                'slug' => 'monitores',
                'descripcion' => 'Categor??a de Monitores',
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
                'descripcion' => 'Categor??a de Acampanados y Molduras de Guardabarros',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-compuerta-trasera-y-forro')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Accesorios para Compuerta Trasera y Forro',
                'slug' => 'accesorios-para-compuerta-trasera-y-forro',
                'descripcion' => 'Categor??a de Accesorios para Compuerta Trasera y Forro',
            ]);
        };

        $categoria = MainCategory::where('slug', 'accesorios-para-remolques')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Accesorios para Remolques',
                'slug' => 'accesorios-para-remolques',
                'descripcion' => 'Categor??a de Accesorios para Remolques',
            ]);
        };

        $categoria = MainCategory::where('slug', 'administracion-de-carga')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Administraci??n de Carga',
                'slug' => 'administracion-de-carga',
                'descripcion' => 'Categor??a de Administraci??n de Carga',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bocinas-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Bocinas y Accesorios',
                'slug' => 'bocinas-y-accesorios',
                'descripcion' => 'Categor??a de Bocinas y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calcomanias-y-etiquetas-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Calcoman??as y Etiquetas',
                'slug' => 'calcomanias-y-etiquetas-automotriz',
                'descripcion' => 'Categor??a de Calcoman??as y Etiquetas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'emblemas-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Emblemas',
                'slug' => 'emblemas-automotriz',
                'descripcion' => 'Categor??a de Emblemas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'espejos-y-partes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Espejos y Partes',
                'slug' => 'espejos-y-partes-automotriz',
                'descripcion' => 'Categor??a de Espejos y Partes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'parachoques-y-accesorios-para-parachoques')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Parachoques y Accesorios para Parachoques',
                'slug' => 'parachoques-y-accesorios-para-parachoques',
                'descripcion' => 'Categor??a de Parachoques y Accesorios para Parachoques',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-accesorios-exteriores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '31',
                'nombre' => 'Otros',
                'slug' => 'otros-accesorios-exteriores',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Accesorios Interiores-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-automotriz',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ambientadores-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Ambientadores',
                'slug' => 'ambientadores-automotriz',
                'descripcion' => 'Categor??a de Ambientadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'alfombras-y-tapetes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Alfombras y Tapetes',
                'slug' => 'alfombras-y-tapetes-automotriz',
                'descripcion' => 'Categor??a de Alfombras y Tapetes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'forros-para-asiento-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Forros para Asiento',
                'slug' => 'forros-para-asiento-automotriz',
                'descripcion' => 'Categor??a de Forros para Asiento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pedales-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Pedales',
                'slug' => 'pedales-automotriz',
                'descripcion' => 'Categor??a de Pedales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'proteccion-antirrobo-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Protecci??n Antirrobo',
                'slug' => 'proteccion-antirrobo-automotriz',
                'descripcion' => 'Categor??a de Protecci??n Antirrobo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'volantes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Volantes',
                'slug' => 'volantes-automotriz',
                'descripcion' => 'Categor??a de Volantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-accesorios-interiores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '32',
                'nombre' => 'Otros',
                'slug' => 'otros-accesorios-interiores',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };






        //--------------------Aceites y Fluidos-------------------------------
        $categoria = MainCategory::where('slug', 'aceites-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Aceites',
                'slug' => 'aceites-automotriz',
                'descripcion' => 'Categor??a de Aceites',
            ]);
        };

        $categoria = MainCategory::where('slug', 'aditivos-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Aditivos',
                'slug' => 'aditivos-automotriz',
                'descripcion' => 'Categor??a de Aditivos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'anticongelantes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Anticongelantes',
                'slug' => 'anticongelantes-automotriz',
                'descripcion' => 'Categor??a de Anticongelantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'fluidos-de-transmision-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Fluidos de Transmisi??n',
                'slug' => 'fluidos-de-transmision-automotriz',
                'descripcion' => 'Categor??a de Fluidos de Transmisi??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'limpiadores-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Limpiadores',
                'slug' => 'limpiadores-automotriz',
                'descripcion' => 'Categor??a de Limpiadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'liquidos-de-direccion-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'L??quidos de Direcci??n',
                'slug' => 'liquidos-de-direccion-automotriz',
                'descripcion' => 'Categor??a de L??quidos de Direcci??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'liquidos-de-freno-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'L??quidos de Freno',
                'slug' => 'liquidos-de-freno-automotriz',
                'descripcion' => 'Categor??a de L??quidos de Freno',
            ]);
        };

        $categoria = MainCategory::where('slug', 'lubricantes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Lubricantes',
                'slug' => 'lubricantes-automotriz',
                'descripcion' => 'Categor??a de Lubricantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'refrigerantes-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Refrigerantes',
                'slug' => 'refrigerantes-automotriz',
                'descripcion' => 'Categor??a de Refrigerantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'selladores-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Selladores',
                'slug' => 'selladores-automotriz',
                'descripcion' => 'Categor??a de Selladores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-aceites-y-fluidos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '33',
                'nombre' => 'Otros',
                'slug' => 'otros-aceites-y-fluidos',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Cuidado Automotriz-------------------------------
        $categoria = MainCategory::where('slug', 'cuidado-de-neumaticos-y-ruedas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Cuidado de Neum??ticos y Ruedas',
                'slug' => 'cuidado-de-neumaticos-y-ruedas',
                'descripcion' => 'Categor??a de Cuidado de Neum??ticos y Ruedas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-del-interior-del-vehiculo')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Cuidado del Interior del Veh??culo',
                'slug' => 'cuidado-del-interior-del-vehiculo',
                'descripcion' => 'Categor??a de Cuidado del Interior del Veh??culo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-exterior')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Cuidado Exterior',
                'slug' => 'cuidado-exterior',
                'descripcion' => 'Categor??a de Cuidado Exterior',
            ]);
        };

        $categoria = MainCategory::where('slug', 'kits-de-limpieza')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Kits de Limpieza',
                'slug' => 'kits-de-limpieza',
                'descripcion' => 'Categor??a de Kits de Limpieza',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-automotriz')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '34',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-automotriz',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };






        //--------------------Herramientas y Equipos-------------------------------
        $categoria = MainCategory::where('slug', 'cables-puente-cargadores-de-bateria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Cables Puente, Cargadores de Bater??a',
                'slug' => 'cables-puente-cargadores-de-bateria',
                'descripcion' => 'Categor??a de Cables Puente, Cargadores de Bater??a',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cajas-de-herramientas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Cajas de Herramientas',
                'slug' => 'cajas-de-herramientas',
                'descripcion' => 'Categor??a de Cajas de Herramientas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'compresores-de-aire-e-infladores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Compresores de Aire e Infladores',
                'slug' => 'compresores-de-aire-e-infladores',
                'descripcion' => 'Categor??a de Compresores de Aire e Infladores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'equipo-de-garaje')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Equipo de Garaje',
                'slug' => 'equipo-de-garaje',
                'descripcion' => 'Categor??a de Equipo de Garaje',
            ]);
        };

        $categoria = MainCategory::where('slug', 'extractores-y-deparadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Extractores y Separadores',
                'slug' => 'extractores-y-deparadores',
                'descripcion' => 'Categor??a de Extractores y Separadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-bujias-e-ignicion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Buj??as e Ignici??n',
                'slug' => 'herramientas-de-bujias-e-ignicion',
                'descripcion' => 'Categor??a de Herramientas de Buj??as e Ignici??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-diagnostico-test-y-medidores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Diagn??stico, Test y Medidores',
                'slug' => 'herramientas-de-diagnostico-test-y-medidores',
                'descripcion' => 'Categor??a de Herramientas de Diagn??stico, Test y Medidores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-direccion-y-suspension')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Direcci??n y Suspensi??n',
                'slug' => 'herramientas-de-direccion-y-suspension',
                'descripcion' => 'Categor??a de Herramientas de Direcci??n y Suspensi??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-frenos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Frenos',
                'slug' => 'herramientas-de-frenos',
                'descripcion' => 'Categor??a de Herramientas de Frenos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-mano')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Mano',
                'slug' => 'herramientas-de-mano',
                'descripcion' => 'Categor??a de Herramientas de Mano',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-neumaticos-y-ruedas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Neum??ticos y Ruedas',
                'slug' => 'herramientas-de-neumaticos-y-ruedas',
                'descripcion' => 'Categor??a de Herramientas de Neum??ticos y Ruedas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-reparacion-de-carroceria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Reparaci??n de Carrocer??a',
                'slug' => 'herramientas-de-reparacion-de-carroceria',
                'descripcion' => 'Categor??a de Herramientas de Reparaci??n de Carrocer??a',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-de-soldadura')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas de Soldadura',
                'slug' => 'herramientas-de-soldadura',
                'descripcion' => 'Categor??a de Herramientas de Soldadura',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-del-sistema-de-aceite-y-equipamiento')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas del Sistema de Aceite y Equipamiento',
                'slug' => 'herramientas-del-sistema-de-aceite-y-equipamiento',
                'descripcion' => 'Categor??a de Herramientas del Sistema de Aceite y Equipamiento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'herramientas-y-equipos-de-motor')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Herramientas y Equipos de Motor',
                'slug' => 'herramientas-y-equipos-de-motor',
                'descripcion' => 'Categor??a de Herramientas y Equipos de Motor',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juegos-de-herramientas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Juegos de Herramientas',
                'slug' => 'juegos-de-herramientas',
                'descripcion' => 'Categor??a de Juegos de Herramientas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'remachadoras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Remachadoras',
                'slug' => 'remachadoras',
                'descripcion' => 'Categor??a de Remachadoras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-herramientas-y-equipos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '35',
                'nombre' => 'Otros',
                'slug' => 'otros-herramientas-y-equipos',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };






        //--------------------Luces y Accesorios de Iluminaci??n-------------------------------
        $categoria = MainCategory::where('slug', 'bombillos-luces-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Bombillos',
                'slug' => 'bombillos-luces-accesorios',
                'descripcion' => 'Categor??a de Bombillos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'iluminacion-de-todoterreno')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Iluminaci??n de Todoterreno',
                'slug' => 'iluminacion-de-todoterreno',
                'descripcion' => 'Categor??a de Iluminaci??n de Todoterreno',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juegos-de-piezas-y-componentes-de-iluminacion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Juegos de Piezas y Componentes de Iluminaci??n',
                'slug' => 'juegos-de-piezas-y-componentes-de-iluminacion',
                'descripcion' => 'Categor??a de Juegos de Piezas y Componentes de Iluminaci??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'kits-de-conversion-de-luces')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Kits de Conversi??n de Luces',
                'slug' => 'kits-de-conversion-de-luces',
                'descripcion' => 'Categor??a de Kits de Conversi??n de Luces',
            ]);
        };

        $categoria = MainCategory::where('slug', 'luces-de-emergencia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Luces de Emergencia',
                'slug' => 'luces-de-emergencia',
                'descripcion' => 'Categor??a de Luces de Emergencia',
            ]);
        };

        $categoria = MainCategory::where('slug', 'luces-para-remolque')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Luces para Remolque',
                'slug' => 'luces-para-remolque',
                'descripcion' => 'Categor??a de Luces para Remolque',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-luces-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '36',
                'nombre' => 'Otros',
                'slug' => 'otros-luces-y-accesorios',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };




        //--------------------Motos, Accesorios y Piezas-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-motos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Accesorios',
                'slug' => 'accesorios-motos',
                'descripcion' => 'Categor??a de Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'fluidos-y-mantenimiento-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Fluidos y Mantenimiento',
                'slug' => 'fluidos-y-mantenimiento-moto',
                'descripcion' => 'Categor??a de Fluidos y Mantenimiento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'neumaticos-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Neum??ticos',
                'slug' => 'neumaticos-moto',
                'descripcion' => 'Categor??a de Neum??ticos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'repuestos-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Repuestos',
                'slug' => 'repuestos-moto',
                'descripcion' => 'Categor??a de Repuestos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ropa-y-accesorios-de-proteccion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Ropa y Accesorios de Protecci??n',
                'slug' => 'ropa-y-accesorios-de-proteccion',
                'descripcion' => 'Categor??a de Ropa y Accesorios de Protecci??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ruedas-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Ruedas',
                'slug' => 'ruedas-moto',
                'descripcion' => 'Categor??a de Ruedas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-moto')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '37',
                'nombre' => 'Otros',
                'slug' => 'otros-moto',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };




        //--------------------Neum??ticos y Ruedas-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-y-repuestos-neumaticos-ruedas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '38',
                'nombre' => 'Accesorios y Repuestos',
                'slug' => 'accesorios-y-repuestos-neumaticos-ruedas',
                'descripcion' => 'Categor??a de Accesorios y Repuestos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'neumaticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '38',
                'nombre' => 'Neum??ticos',
                'slug' => 'neumaticos',
                'descripcion' => 'Categor??a de Neum??ticos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ruedas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '38',
                'nombre' => 'Ruedas',
                'slug' => 'ruedas',
                'descripcion' => 'Categor??a de Ruedas',
            ]);
        };




        //--------------------Pintura y Suministros de Pintura-------------------------------
        $categoria = MainCategory::where('slug', 'pinturas-y-accesorios-de-pintura')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '39',
                'nombre' => 'Pinturas y Accesorios de Pintura',
                'slug' => 'pinturas-y-accesorios-de-pintura',
                'descripcion' => 'Categor??a de Pinturas y Accesorios de Pintura',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pistolas-y-accesorios-de-pintura')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '39',
                'nombre' => 'Pistolas y Accesorios de Pintura',
                'slug' => 'pistolas-y-accesorios-de-pintura',
                'descripcion' => 'Categor??a de Pistolas y Accesorios de Pintura',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pulitura-vehiculos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '39',
                'nombre' => 'Pulitura Veh??culos',
                'slug' => 'pulitura-vehiculos',
                'descripcion' => 'Categor??a de Pulitura Veh??culos',
            ]);
        };



        //--------------------Repuestos-------------------------------
        $categoria = MainCategory::where('slug', 'arranques-y-alternadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Arranques y Alternadores',
                'slug' => 'arranques-y-alternadores',
                'descripcion' => 'Categor??a de Arranques y Alternadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'baterias-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Bater??as y Accesorios',
                'slug' => 'baterias-y-accesorios',
                'descripcion' => 'Categor??a de Bater??as y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cables-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Cables',
                'slug' => 'cables-repuestos',
                'descripcion' => 'Categor??a de Cables',
            ]);
        };

        $categoria = MainCategory::where('slug', 'correas-y-tensores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Correas y Tensores',
                'slug' => 'correas-y-tensores',
                'descripcion' => 'Categor??a de Correas y Tensores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'direccion-y-suspension')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Direcci??n y Suspensi??n',
                'slug' => 'direccion-y-suspension',
                'descripcion' => 'Categor??a de Direcci??n y Suspensi??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'embellecedores-y-accesorios-para-carroceria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Embellecedores y Accesorios para Carrocer??a',
                'slug' => 'embellecedores-y-accesorios-para-carroceria',
                'descripcion' => 'Categor??a de Embellecedores y Accesorios para Carrocer??a',
            ]);
        };

        $categoria = MainCategory::where('slug', 'encendido-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Encendido y Accesorios',
                'slug' => 'encendido-y-accesorios',
                'descripcion' => 'Categor??a de Encendido y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'filtros-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Filtros',
                'slug' => 'filtros-repuestos',
                'descripcion' => 'Categor??a de Filtros',
            ]);
        };

        $categoria = MainCategory::where('slug', 'frenos-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Frenos',
                'slug' => 'frenos-repuestos',
                'descripcion' => 'Categor??a de Frenos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'interruptores-y-reles')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Interruptores y Rel??s',
                'slug' => 'interruptores-y-reles',
                'descripcion' => 'Categor??a de Interruptores y Rel??s',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juntas-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Juntas',
                'slug' => 'juntas-repuestos',
                'descripcion' => 'Categor??a de Juntas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'limpiaparabrisas-y-partes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Limpiaparabrisas y Partes',
                'slug' => 'limpiaparabrisas-y-partes',
                'descripcion' => 'Categor??a de Limpiaparabrisas y Partes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'luz-y-electricidad-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Luz y Electricidad',
                'slug' => 'luz-y-electricidad-repuestos',
                'descripcion' => 'Categor??a de Luz y Electricidad',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mallas-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Mallas',
                'slug' => 'mallas-repuestos',
                'descripcion' => 'Categor??a de Mallas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'motores-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Motores',
                'slug' => 'motores-repuestos',
                'descripcion' => 'Categor??a de Motores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'motores-y-piezas-del-motor')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Motores y Piezas del Motor',
                'slug' => 'motores-y-piezas-del-motor',
                'descripcion' => 'Categor??a de Motores y Piezas del Motor',
            ]);
        };

        $categoria = MainCategory::where('slug', 'reguladores-y-motores-de-ventana')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Reguladores y Motores de Ventana',
                'slug' => 'reguladores-y-motores-de-ventana',
                'descripcion' => 'Categor??a de Reguladores y Motores de Ventana',
            ]);
        };

        $categoria = MainCategory::where('slug', 'rodamientos-y-juntas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Rodamientos y Juntas',
                'slug' => 'rodamientos-y-juntas',
                'descripcion' => 'Categor??a de Rodamientos y Juntas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sensores-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Sensores',
                'slug' => 'sensores-repuestos',
                'descripcion' => 'Categor??a de Sensores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistema-de-direccion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Sistema de Direcci??n',
                'slug' => 'sistema-de-direccion',
                'descripcion' => 'Categor??a de Sistema de Direcci??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistemas-de-escape')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Sistemas de Escape',
                'slug' => 'sistemas-de-escape',
                'descripcion' => 'Categor??a de Sistemas de Escape',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sistemas-de-refrigeracion')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Sistemas de Refrigeraci??n',
                'slug' => 'sistemas-de-refrigeracion',
                'descripcion' => 'Categor??a de Sistemas de Refrigeraci??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'suministro-y-tratamiento-de-combustible')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Suministro y Tratamiento de Combustible',
                'slug' => 'suministro-y-tratamiento-de-combustible',
                'descripcion' => 'Categor??a de Suministro y Tratamiento de Combustible',
            ]);
        };

        $categoria = MainCategory::where('slug', 'traccion-y-transmision')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Tracci??n y Transmisi??n',
                'slug' => 'traccion-y-transmision',
                'descripcion' => 'Categor??a de Tracci??n y Transmisi??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-repuestos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '40',
                'nombre' => 'Otros',
                'slug' => 'otros-repuestos',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };



        //--------------------Sonido-------------------------------
        $categoria = MainCategory::where('slug', 'antenas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Antenas',
                'slug' => 'antenas-sonido',
                'descripcion' => 'Categor??a de Antenas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bazookas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Bazookas',
                'slug' => 'bazookas-sonido',
                'descripcion' => 'Categor??a de Bazookas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cables-y-conectores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Cables y Conectores',
                'slug' => 'cables-y-conectores-sonido',
                'descripcion' => 'Categor??a de Cables y Conectores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cajas-acusticas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Cajas Ac??sticas',
                'slug' => 'cajas-acusticas-sonido',
                'descripcion' => 'Categor??a de Cajas Ac??sticas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'capacitores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Capacitores',
                'slug' => 'capacitores-sonido',
                'descripcion' => 'Categor??a de Capacitores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'controles-remotos-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Controles Remotos',
                'slug' => 'controles-remotos-sonido',
                'descripcion' => 'Categor??a de Controles Remotos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cornetas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Cornetas',
                'slug' => 'cornetas-sonido',
                'descripcion' => 'Categor??a de Cornetas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'difusores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Difusores',
                'slug' => 'difusores-sonido',
                'descripcion' => 'Categor??a de Difusores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'drivers-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Drivers',
                'slug' => 'drivers-sonido',
                'descripcion' => 'Categor??a de Drivers',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ecualizadores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Ecualizadores',
                'slug' => 'ecualizadores-sonido',
                'descripcion' => 'Categor??a de Ecualizadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pantallas-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Pantallas',
                'slug' => 'pantallas-sonido',
                'descripcion' => 'Categor??a de Pantallas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'plantas-y-ecualizadores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Plantas y Ecualizadores',
                'slug' => 'plantas-y-ecualizadores-sonido',
                'descripcion' => 'Categor??a de Plantas y Ecualizadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'reproductores-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Reproductores',
                'slug' => 'reproductores-sonido',
                'descripcion' => 'Categor??a de Reproductores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'subwoofers-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'SubWoofers',
                'slug' => 'subwoofers-sonido',
                'descripcion' => 'Categor??a de SubWoofers',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tweeters-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Tweeters',
                'slug' => 'tweeters-sonido',
                'descripcion' => 'Categor??a de Tweeters',
            ]);
        };

        $categoria = MainCategory::where('slug', 'woofers-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Woofers',
                'slug' => 'woofers-sonido',
                'descripcion' => 'Categor??a de Woofers',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-sonido')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '41',
                'nombre' => 'Otros',
                'slug' => 'otros-sonido',
                'descripcion' => 'Categor??a de Otros',
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
                'descripcion' => 'Categor??a de Aguas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bebidas-blancas-y-licores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Bebidas Blancas y Licores',
                'slug' => 'bebidas-blancas-y-licores',
                'descripcion' => 'Categor??a de Bebidas Blancas y Licores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bebidas-deportivas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Bebidas Deportivas',
                'slug' => 'bebidas-deportivas',
                'descripcion' => 'Categor??a de Bebidas Deportivas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bebidas-energeticas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Bebidas Energ??ticas',
                'slug' => 'bebidas-energeticas',
                'descripcion' => 'Categor??a de Bebidas Energ??ticas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cerveza')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Cerveza',
                'slug' => 'cerveza',
                'descripcion' => 'Categor??a de Cerveza',
            ]);
        };

        $categoria = MainCategory::where('slug', 'jugos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Jugos',
                'slug' => 'jugos',
                'descripcion' => 'Categor??a de Jugos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'refrescos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Refrescos',
                'slug' => 'refrescos',
                'descripcion' => 'Categor??a de Refrescos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'vinos-y-espumantes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Vinos y Espumantes',
                'slug' => 'vinos-y-espumantes',
                'descripcion' => 'Categor??a de Vinos y Espumantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-bebidas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '42',
                'nombre' => 'Otros',
                'slug' => 'otros-bebidas',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };




        //--------------------Comestibles-------------------------------
        $categoria = MainCategory::where('slug', 'aceites-y-vinagres')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Aceites y Vinagres',
                'slug' => 'aceites-y-vinagres',
                'descripcion' => 'Categor??a de Aceites y Vinagres',
            ]);
        };

        $categoria = MainCategory::where('slug', 'alimentos-instantaneos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Alimentos Instant??neos',
                'slug' => 'alimentos-instantaneos',
                'descripcion' => 'Categor??a de Alimentos Instant??neos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'arroz-legumbres-y-semillas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Arroz, Legumbres y Semillas',
                'slug' => 'arroz-legumbres-y-semillas',
                'descripcion' => 'Categor??a de Arroz, Legumbres y Semillas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'azucar-y-endulzantes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Az??car y Endulzantes',
                'slug' => 'azucar-y-endulzantes',
                'descripcion' => 'Categor??a de Az??car y Endulzantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cereales-y-barras')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Cereales y Barras',
                'slug' => 'cereales-y-barras',
                'descripcion' => 'Categor??a de Cereales y Barras',
            ]);
        };

        $categoria = MainCategory::where('slug', 'dulces-y-chocolates')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Dulces y Chocolates',
                'slug' => 'dulces-y-chocolates',
                'descripcion' => 'Categor??a de Dulces y Chocolates',
            ]);
        };

        $categoria = MainCategory::where('slug', 'infusiones')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Infusiones',
                'slug' => 'infusiones',
                'descripcion' => 'Categor??a de Infusiones',
            ]);
        };

        $categoria = MainCategory::where('slug', 'leches-y-cremas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Leches y Cremas',
                'slug' => 'leches-y-cremas',
                'descripcion' => 'Categor??a de Leches y Cremas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mermeladas-dulces-y-miel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Mermeladas, Dulces y Miel',
                'slug' => 'mermeladas-dulces-y-miel',
                'descripcion' => 'Categor??a de Mermeladas, Dulces y Miel',
            ]);
        };

        $categoria = MainCategory::where('slug', 'panaderia-y-reposteria')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Panader??a y Reposter??a',
                'slug' => 'panaderia-y-reposteria',
                'descripcion' => 'Categor??a de Panader??a y Reposter??a',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pastas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Pastas',
                'slug' => 'pastas',
                'descripcion' => 'Categor??a de Pastas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'saborizantes-y-jarabes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Saborizantes y Jarabes',
                'slug' => 'saborizantes-y-jarabes',
                'descripcion' => 'Categor??a de Saborizantes y Jarabes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'salsas-y-condimentos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Salsas y Condimentos',
                'slug' => 'salsas-y-condimentos',
                'descripcion' => 'Categor??a de Salsas y Condimentos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'snacks')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Snacks',
                'slug' => 'snacks',
                'descripcion' => 'Categor??a de Snacks',
            ]);
        };

        $categoria = MainCategory::where('slug', 'yogures')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Yogures',
                'slug' => 'yogures',
                'descripcion' => 'Categor??a de Yogures',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-comestibles')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '43',
                'nombre' => 'Otros',
                'slug' => 'otros-comestibles',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };




        //--------------------Comida Preparada-------------------------------
        $categoria = MainCategory::where('slug', 'almuerzos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Almuerzos',
                'slug' => 'almuerzos',
                'descripcion' => 'Categor??a de Almuerzos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'arepas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Arepas',
                'slug' => 'arepas',
                'descripcion' => 'Categor??a de Arepas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bandejas-dulces-y-saladas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Bandejas Dulces y Saladas',
                'slug' => 'bandejas-dulces-y-saladas',
                'descripcion' => 'Categor??a de Bandejas Dulces y Saladas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'comida-preparada')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Comida Preparada',
                'slug' => 'comida-preparada',
                'descripcion' => 'Categor??a de Comida Preparada',
            ]);
        };

        $categoria = MainCategory::where('slug', 'desayunos-y-meriendas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Desayunos y Meriendas',
                'slug' => 'desayunos-y-meriendas',
                'descripcion' => 'Categor??a de Desayunos y Meriendas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'empanadas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Empanadas',
                'slug' => 'empanadas',
                'descripcion' => 'Categor??a de Empanadas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'helados')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Helados',
                'slug' => 'helados',
                'descripcion' => 'Categor??a de Helados',
            ]);
        };

        $categoria = MainCategory::where('slug', 'sandwiches')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Sandwiches',
                'slug' => 'sandwiches',
                'descripcion' => 'Categor??a de Sandwiches',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tablas-de-pasapalos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Tablas de Pasapalos',
                'slug' => 'tablas-de-pasapalos',
                'descripcion' => 'Categor??a de Tablas de Pasapalos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tartas-saladas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Tartas Saladas',
                'slug' => 'tartas-saladas',
                'descripcion' => 'Categor??a de Tartas Saladas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tortas-y-tartas-dulces')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Tortas y Tartas Dulces',
                'slug' => 'tortas-y-tartas-dulces',
                'descripcion' => 'Categor??a de Tortas y Tartas Dulces',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-comida-preparada')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '44',
                'nombre' => 'Otros',
                'slug' => 'otros-comida-preparada',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };








        //--------------------Belleza y Cuidado Personal-------------------------------
        //--------------------Art??culos y Accesorios-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-de-bano')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Accesorios de Ba??o',
                'slug' => 'accesorios-de-bano',
                'descripcion' => 'Categor??a de Accesorios de Ba??o',
            ]);
        };

        $categoria = MainCategory::where('slug', 'aparatos-y-utensilios-de-peinado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Aparatos y Utensilios de Peinado',
                'slug' => 'aparatos-y-utensilios-de-peinado',
                'descripcion' => 'Categor??a de Aparatos y Utensilios de Peinado',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bolitas-e-hisopos-de-algodon')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Bolitas e Hisopos de Algod??n',
                'slug' => 'bolitas-e-hisopos-de-algodon',
                'descripcion' => 'Categor??a de Bolitas e Hisopos de Algod??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'bolsas-y-estuches')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Bolsas y Estuches',
                'slug' => 'bolsas-y-estuches',
                'descripcion' => 'Categor??a de Bolsas y Estuches',
            ]);
        };

        $categoria = MainCategory::where('slug', 'calefactores-y-calentadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Calefactores y Calentadores',
                'slug' => 'calefactores-y-calentadores',
                'descripcion' => 'Categor??a de Calefactores y Calentadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cepillos-y-utensilios-de-maquillaje')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Cepillos y Utensilios de Maquillaje',
                'slug' => 'cepillos-y-utensilios-de-maquillaje',
                'descripcion' => 'Categor??a de Cepillos y Utensilios de Maquillaje',
            ]);
        };

        $categoria = MainCategory::where('slug', 'equipo-de-spa-y-salon')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Equipo de Spa y Sal??n',
                'slug' => 'equipo-de-spa-y-salon',
                'descripcion' => 'Categor??a de Equipo de Spa y Sal??n',
            ]);
        };

        $categoria = MainCategory::where('slug', 'espejos-articulos-belleza')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Espejos',
                'slug' => 'espejos-articulos-belleza',
                'descripcion' => 'Categor??a de Espejos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-para-cuidado-de-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Instrumentos para Cuidado de Piel',
                'slug' => 'instrumentos-para-cuidado-de-piel',
                'descripcion' => 'Categor??a de Instrumentos para Cuidado de Piel',
            ]);
        };

        $categoria = MainCategory::where('slug', 'instrumentos-para-peinado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '45',
                'nombre' => 'Instrumentos para Peinado',
                'slug' => 'instrumentos-para-peinado',
                'descripcion' => 'Categor??a de Instrumentos para Peinado',
            ]);
        };




        //--------------------Afeitado y Depilaci??n-------------------------------
        $categoria = MainCategory::where('slug', 'hombres-afeitado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '46',
                'nombre' => 'Hombres',
                'slug' => 'hombres-afeitado',
                'descripcion' => 'Categor??a de Hombres',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mujeres-afeitado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '46',
                'nombre' => 'Mujeres',
                'slug' => 'mujeres-afeitado',
                'descripcion' => 'Categor??a de Mujeres',
            ]);
        };






        //--------------------Cosm??ticos-------------------------------
        $categoria = MainCategory::where('slug', 'bases-y-polvos-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Bases y Polvos',
                'slug' => 'bases-y-polvos-cosmeticos',
                'descripcion' => 'Categor??a de Bases y Polvos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'brochas-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Brochas',
                'slug' => 'brochas-cosmeticos',
                'descripcion' => 'Categor??a de Brochas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'correctores-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Correctores',
                'slug' => 'correctores-cosmeticos',
                'descripcion' => 'Categor??a de Correctores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'desmaquillantes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Desmaquillantes',
                'slug' => 'desmaquillantes',
                'descripcion' => 'Categor??a de Desmaquillantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'hidratantes-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Hidratantes',
                'slug' => 'hidratantes-cosmeticos',
                'descripcion' => 'Categor??a de Hidratantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'labiales-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Labiales',
                'slug' => 'labiales-cosmeticos',
                'descripcion' => 'Categor??a de Labiales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'paletas-de-sombras-contornos-iluminadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Paletas de Sombras, Contornos e Iluminadores',
                'slug' => 'paletas-de-sombras-contornos-iluminadores',
                'descripcion' => 'Categor??a de Paletas de Sombras, Contornos e Iluminadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'primer-cosmetico')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Primer',
                'slug' => 'primer-cosmetico',
                'descripcion' => 'Categor??a de Primer',
            ]);
        };



        //--------------------Cuidado Bucal-------------------------------
        $categoria = MainCategory::where('slug', 'articulos-de-ortodoncia')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Art??culos de Ortodoncia',
                'slug' => 'articulos-de-ortodoncia',
                'descripcion' => 'Categor??a de Art??culos de Ortodoncia',
            ]);
        };

        $categoria = MainCategory::where('slug', 'blanqueadores-dentales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Blanqueadores Dentales',
                'slug' => 'blanqueadores-dentales',
                'descripcion' => 'Categor??a de Blanqueadores Dentales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cepillos-de-dientes-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Cepillos de Dientes y Accesorios',
                'slug' => 'cepillos-de-dientes-y-accesorios',
                'descripcion' => 'Categor??a de Cepillos de Dientes y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-de-dentaduras-postizas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Cuidado de Dentaduras Postizas',
                'slug' => 'cuidado-de-dentaduras-postizas',
                'descripcion' => 'Categor??a de Cuidado de Dentaduras Postizas',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-dental-para-ninos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Cuidado Dental para Ni??os',
                'slug' => 'cuidado-dental-para-ninos',
                'descripcion' => 'Categor??a de Cuidado Dental para Ni??os',
            ]);
        };

        $categoria = MainCategory::where('slug', 'enjuagues-bucales')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Enjuagues Bucales',
                'slug' => 'enjuagues-bucales',
                'descripcion' => 'Categor??a de Enjuagues Bucales',
            ]);
        };

        $categoria = MainCategory::where('slug', 'hilo-dental-y-palillos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Hilo Dental y Palillos',
                'slug' => 'hilo-dental-y-palillos',
                'descripcion' => 'Categor??a de Hilo Dental y Palillos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'limpiadores-de-lengua')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Limpiadores de Lengua',
                'slug' => 'limpiadores-de-lengua',
                'descripcion' => 'Categor??a de Limpiadores de Lengua',
            ]);
        };

        $categoria = MainCategory::where('slug', 'pastas-de-dientes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Pastas de Dientes',
                'slug' => 'pastas-de-dientes',
                'descripcion' => 'Categor??a de Pastas de Dientes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'refrescantes-de-aliento')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Refrescantes de Aliento',
                'slug' => 'refrescantes-de-aliento',
                'descripcion' => 'Categor??a de Refrescantes de Aliento',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tratamientos-para-sensibilidad')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Tratamientos para Sensibilidad',
                'slug' => 'tratamientos-para-sensibilidad',
                'descripcion' => 'Categor??a de Tratamientos para Sensibilidad',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-bucal')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '48',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-bucal',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Cuidado Personal-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-de-bano')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Accesorios de Ba??o',
                'slug' => 'accesorios-de-bano',
                'descripcion' => 'Categor??a de Accesorios de Ba??o',
            ]);
        };

        $categoria = MainCategory::where('slug', 'articulos-de-higiene-personal')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Art??culos de Higiene Personal',
                'slug' => 'articulos-de-higiene-personal',
                'descripcion' => 'Categor??a de Art??culos de Higiene Personal',
            ]);
        };

        $categoria = MainCategory::where('slug', 'articulos-para-piercing-y-tatuajes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Art??culos para Piercing y Tatuajes',
                'slug' => 'articulos-para-piercing-y-tatuajes',
                'descripcion' => 'Categor??a de Art??culos para Piercing y Tatuajes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'cuidado-para-labios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Cuidado para Labios',
                'slug' => 'cuidado-para-labios',
                'descripcion' => 'Categor??a de Cuidado para Labios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'desodorantes-y-antitranspirantes')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Desodorantes y Antitranspirantes',
                'slug' => 'desodorantes-y-antitranspirantes',
                'descripcion' => 'Categor??a de Desodorantes y Antitranspirantes',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-personal')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '49',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-personal',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Cuidado del Cabello-------------------------------
        $categoria = MainCategory::where('slug', 'accesorios-para-peinarse')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Accesorios para Peinarse',
                'slug' => 'accesorios-para-peinarse',
                'descripcion' => 'Categor??a de Accesorios para Peinarse',
            ]);
        };

        $categoria = MainCategory::where('slug', 'aceites-para-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Aceites para Cabello',
                'slug' => 'aceites-para-cabello',
                'descripcion' => 'Categor??a de Aceites para Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'aparatos-y-utensilios-de-peinado')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Aparatos y Utensilios de Peinado',
                'slug' => 'aparatos-y-utensilios-de-peinado',
                'descripcion' => 'Categor??a de Aparatos y Utensilios de Peinado',
            ]);
        };

        $categoria = MainCategory::where('slug', 'caida-de-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Ca??da de Cabello',
                'slug' => 'caida-de-cabello',
                'descripcion' => 'Categor??a de Ca??da de Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'champu-y-acondicionador')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Champ?? y Acondicionador',
                'slug' => 'champu-y-acondicionador',
                'descripcion' => 'Categor??a de Champ?? y Acondicionador',
            ]);
        };

        $categoria = MainCategory::where('slug', 'extensiones-pelucas-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Extensiones, Pelucas y Accesorios',
                'slug' => 'extensiones-pelucas-y-accesorios',
                'descripcion' => 'Categor??a de Extensiones, Pelucas y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mascarillas-para-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Mascarillas para Cabello',
                'slug' => 'mascarillas-para-cabello',
                'descripcion' => 'Categor??a de Mascarillas para Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'permanentes-relajantes-y-texturizadores')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Permanentes, Relajantes y Texturizadores',
                'slug' => 'permanentes-relajantes-y-texturizadores',
                'descripcion' => 'Categor??a de Permanentes, Relajantes y Texturizadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'productos-para-peinar')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Productos para Peinar',
                'slug' => 'productos-para-peinar',
                'descripcion' => 'Categor??a de Productos para Peinar',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tintes-para-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Tintes para Cabello',
                'slug' => 'tintes-para-cabello',
                'descripcion' => 'Categor??a de Tintes para Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'utensillos-para-cortar-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Utensillos para Cortar Cabello',
                'slug' => 'utensillos-para-cortar-cabello',
                'descripcion' => 'Categor??a de Utensillos para Cortar Cabello',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-cabello')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '50',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-cabello',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };





        //--------------------Cuidado de la Piel-------------------------------
        $categoria = MainCategory::where('slug', 'cuerpo-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Cuerpo',
                'slug' => 'cuerpo-cuidado-piel',
                'descripcion' => 'Categor??a de Cuerpo',
            ]);
        };

        $categoria = MainCategory::where('slug', 'juegos-y-kits')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Juegos y Kits',
                'slug' => 'juegos-y-kits',
                'descripcion' => 'Categor??a de Juegos y Kits',
            ]);
        };

        $categoria = MainCategory::where('slug', 'maternidad-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Maternidad',
                'slug' => 'maternidad-cuidado-piel',
                'descripcion' => 'Categor??a de Maternidad',
            ]);
        };

        $categoria = MainCategory::where('slug', 'ojos-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Ojos',
                'slug' => 'ojos-cuidado-piel',
                'descripcion' => 'Categor??a de Ojos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'protectores-solares-y-bronceadores-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Protectores Solares y Bronceadores',
                'slug' => 'protectores-solares-y-bronceadores-cuidado-piel',
                'descripcion' => 'Categor??a de Protectores Solares y Bronceadores',
            ]);
        };

        $categoria = MainCategory::where('slug', 'rostro-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Rostro',
                'slug' => 'rostro-cuidado-piel',
                'descripcion' => 'Categor??a de Rostro',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-piel')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '51',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-piel',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };



        //--------------------Cuidado de Pies, Manos y U??as-------------------------------
        $categoria = MainCategory::where('slug', 'cuidado-de-pies-y-manos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Cuidado de Pies y Manos',
                'slug' => 'cuidado-de-pies-y-manos',
                'descripcion' => 'Categor??a de Cuidado de Pies y Manos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'esmalte-y-decoracion-de-unas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Esmalte y Decoraci??n de U??as',
                'slug' => 'esmalte-y-decoracion-de-unas',
                'descripcion' => 'Categor??a de Esmalte y Decoraci??n de U??as',
            ]);
        };

        $categoria = MainCategory::where('slug', 'tratamientos-para-unas')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Tratamientos para U??as',
                'slug' => 'tratamientos-para-unas',
                'descripcion' => 'Categor??a de Tratamientos para U??as',
            ]);
        };

        $categoria = MainCategory::where('slug', 'utensilios-y-accesorios')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Utensilios y Accesorios',
                'slug' => 'utensilios-y-accesorios',
                'descripcion' => 'Categor??a de Utensilios y Accesorios',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-cuidado-pies-manos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '52',
                'nombre' => 'Otros',
                'slug' => 'otros-cuidado-pies-manos',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };




        //--------------------Fragancia-------------------------------
        $categoria = MainCategory::where('slug', 'combos-juegos-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Combos, Juegos',
                'slug' => 'combos-juegos-fragancias',
                'descripcion' => 'Categor??a de Combos, Juegos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'hombres-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Hombres',
                'slug' => 'hombres-fragancias',
                'descripcion' => 'Categor??a de Hombres',
            ]);
        };

        $categoria = MainCategory::where('slug', 'mujeres-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Mujeres',
                'slug' => 'mujeres-fragancias',
                'descripcion' => 'Categor??a de Mujeres',
            ]);
        };
        
        $categoria = MainCategory::where('slug', 'ninos-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Ni??os',
                'slug' => 'ninos-fragancias',
                'descripcion' => 'Categor??a de Ni??os',
            ]);
        };

        $categoria = MainCategory::where('slug', 'talcos-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Talcos',
                'slug' => 'talcos-fragancias',
                'descripcion' => 'Categor??a de Talcos',
            ]);
        };

        $categoria = MainCategory::where('slug', 'otros-fragancias')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '53',
                'nombre' => 'Otros',
                'slug' => 'otros-fragancias',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };












        // --------------- Nuevos Agreados ----------------------

        // Cosm??ticos
        $categoria = MainCategory::where('slug', 'rimel-mascarilla-cosmetico')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Rimel / Mascarilla',
                'slug' => 'rimel-mascarilla-cosmetico',
                'descripcion' => 'Categor??a de Rimel / Mascarilla',
            ]);
        };

        $categoria = MainCategory::where('slug', 'rubor-cosmetico')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Rubor',
                'slug' => 'rubor-cosmetico',
                'descripcion' => 'Categor??a de Rubor',
            ]);
        };
        
        $categoria = MainCategory::where('slug', 'otros-cosmeticos')->first();
        if (!$categoria) {
            $categoria = MainCategory::create([
                'sub_category_id' => '47',
                'nombre' => 'Otros',
                'slug' => 'otros-cosmeticos',
                'descripcion' => 'Categor??a de Otros',
            ]);
        };




        
    }
}
