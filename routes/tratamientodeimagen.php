<?php

//0 To know if a user has an image or not
$usuario = App\User::find(1);

$image = $usuario->image;

if ($image) {
    echo 'tiene una imagen';
} else {
    echo 'No tiene imagen';
}

return $image;


//01 create an image for a user using method save
$imagen = new App\Image(['url' => 'imagenes'.DS.'avatar.png']);

$usuario = App\User::find(1);

$usuario->image()->save($imagen);

return $usuario;

//02 Get the info of the images by users
$usuario = App\User::find(1);

return $usuario->image;


//03 create many images for a product using method savemany
$producto = App\Product::find(1);

$producto->images()->saveMany([
    new App\Image(['url'=>'imagenes'.DS.'avatar.png']),
    new App\Image(['url'=>'imagenes'.DS.'avatar2.png']),
    new App\Image(['url'=>'imagenes'.DS.'avatar3.png']),
]);

return $producto->images;


//04 create an image for a user using method create
$usuario = App\User::find(1);

$usuario->image()->create([
    'url' => 'imagenes'.DS.'avatar2.png'
]);

return $usuario;

//another way would be like this
$imagen = [];

$imagen['url'] = 'imagenes'.DS.'avatar3.png';

$usuario = App\User::find(1);

$usuario->image()->create($imagen);

return $usuario;


//05 create many images for a product using method createmany
$imagen = [];

$imagen[]['url'] = 'imagenes'.DS.'avatar.png';
$imagen[]['url'] = 'imagenes'.DS.'avatar2.png';
$imagen[]['url'] = 'imagenes'.DS.'avata3.png';
$imagen[]['url'] = 'imagenes'.DS.'a.png';
$imagen[]['url'] = 'imagenes'.DS.'a.png';
$imagen[]['url'] = 'imagenes'.DS.'a.png';

$producto = App\Product::find(2);

$producto->images()->createMany($imagen);

return $producto->images;


//06 update the user's image
$usuario = App\User::find(1);

$usuario->image->url='imagenes'.DS.'avatar2.png';

$usuario->push();

return $usuario->image;

//07 update the products's images
$producto = App\Product::find(1);

$producto->images[0]->url='imagenes'.DS.'a.png';
$producto->push();

return $producto->images;

//08 Look for the related record in the image
$image = App\Image::find(9);

return $image->imageable;

//09 delimitating the registers
$producto = App\Product::find(2);

return $producto->images()->where('url','imagenes'.DS.'a.png')->get();


//10 sort the registers obtained by the relation
$producto = App\Product::find(2);

return $producto->images()->where('url','imagenes'.DS.'a.png')->orderBy('id','Desc')->get();

//11 count the related registers to users
$usuario = App\User::withCount('image')->get();
$usuario = $usuario->find(1);
return $usuario;

//12 count the related registers to products
$productos = App\Product::withCount('images')->get();
$productos = $productos->find(1);
return $productos;

//13 count the related registers to products another way
$productos = App\Product::find(2);
return $productos->loadCount('images');


//14 lazy loading -> carga diferida
$producto = App\Product::find(3);

$imagen = $producto->image;

$categoria = $producto->category;


//15 eager loading -> carga previa
$usuario = App\User::with('images','category')->get();

return $usuario;


//16 eager loading -> carga previa
$producto = App\Product::with('images','category')->get();

return $producto;

//17 previous load
$usuario = App\User::with('image')->find(1);

return $usuario;


//18 previous load of multiple relations
$producto = App\Product::with('images', 'category')->find(1);

return $producto;

//19 delimit the fields
$producto = App\Product::with('images:id,imageable_id,url', 'category:id,nombre,slug')->find(1);

return $producto;


//19 delete one image
$producto = App\Product::find(1);
$producto->images[0]->delete();

return $producto;

//20 delete all images
$producto = App\Product::find(2);
$producto->images()->delete();

return $producto;