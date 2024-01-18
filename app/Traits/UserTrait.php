<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

use App\Models\User;

trait UserTrait
{
    public function loadUser($id)
    {
        return User::find($id);
    }
    public function saveUser($request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image = $request->file('image')->store('public/images/photos');
            $image = Storage::url($image); // el facade storage sustituye el public/images/photos por storage/images/photos
            // $image = $this->saveImage($request); usado caso infinity sin poder hacer php artisan storage::link
        }

        if ($request->id > 0) {
            $user = $this->loadUser($request->id);
            if (!$user) {
                return redirect()
                    ->route('crud.index')
                    ->with('message', 'ID ' . $request->id . ' seleccionado no existe en la BD. No se procesaron los cambios. Verifique');
            }
            return $this->updateUser($request, $user, $image);
        }
        return $this->createUser($request, $image);
    }

    public function createUser($request, $image)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'image' => $image,
        ]);
        return "Usuario $request->name " . config('constants.messageSuccess');
    }

    public function updateUser($request, $user, $image)
    {
        $nameOld = $user->name;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->image = $request->hasFile('image') ? $image : $user->image;
        $user->save();
        return "Usuario $request->name " . config('constants.messageUpdate');
    }

    public function deleteUser($id)
    {
        $user = $this->loadUser($id);
        $nameUser = $user->name;
        $user->delete();
        return "Usuario $nameUser " . config('constants.messageDelete');
    }

    public function saveImage($request)
    {
        $destinationPath = public_path() . '\images\photos';
        $nameImgProduct = time() . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $nameImgProduct);
        return $nameImgProduct;
    }
}
