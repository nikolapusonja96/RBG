<?php


namespace App\Http\Controllers;

use App\Http\Models\CommentModel;
use App\Http\Models\KitchensModel;
use App\Http\Models\MenuModel;
use App\Http\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AdminController extends BaseController
{
    //insert
    public function adminIndex()
    {
        return view('pages.admin.index', $this->data);
    }

    public function showInsertCategoryForm()
    {
        return view('pages.admin.insertCategory', $this->data);
    }

    public function addCategory(Request $request)
    {
        $this->admin->category_name = $request->input('categoryName');

        try
        {
            $this->admin->addCategory();
            return redirect()->back()->with('message','Uspešno ste dodali kategoriju');
        }
        catch (QueryException $exception)
        {
            Log::info("Neuspešno dodavanje kategorije!" .$exception->getMessage());
            return redirect()->back()->with('message', 'Greška pri dodavanju kategorije');
        }
    }

    public function showInsertKitchenForm()
    {
        return view('pages.admin.insertKitchen', $this->data);
    }
    public function addKitchen(Request $request)
    {
        $this->admin->kitchen_name = $request->input('kitchenName');

        try
        {
            $this->admin->addKitchen();
            return redirect()->back()->with('message','Uspešno ste dodali kuhinju');
        }
        catch (QueryException $exception)
        {
            Log::info("Neuspešno dodavanje kuhinje!" .$exception->getMessage());
            return redirect()->back()->with('message', 'Greška pri dodavanju kuhinje');
        }
    }

    public function showInsertLinkForm()
    {
        return view('pages.admin.insertLink', $this->data);
    }

    public function addLink(Request $request)
    {
        $this->admin->text = $request->input('linkName');
        $this->admin->link = $request->input('path');

        try
        {
            $this->admin->addLink();
            return redirect()->back()->with('message','Uspešno ste dodali link');
        }
        catch (QueryException $exception)
        {
            Log::info("Neuspešno dodavanje linka!" .$exception->getMessage());
            return redirect()->back()->with('message', 'Greška pri dodavanju linka');
        }
    }

    public function showInsertSliderForm()
    {
        return view('pages.admin.insertSlider', $this->data);
    }

    public function addSlider(Request $request)
    {
        $this->admin->description_slider = $request->input('description');
        $this->admin->slider_type = $request->input('slider');
        $image = $request->file('sliderImg');

        $tmp_path = $image->getPathName();
        $extension = $image->getClientOriginalExtension();
        $file_name = time() . '.' .$extension;

        $this->admin->img_slider = $path = './img/'.$file_name;

        if($image->isValid())
        {
            File::move($tmp_path, $path);

            $this->admin->addSlider();

            return redirect()->back()->with('message', 'Uspešno ste dodali sliku u slajder');
        }
        else{
            return redirect()->back()->with('message', 'Greška!');
        }
    }

    //delete
    public function showDeleteSliderForm()
    {
        $slider = new SliderModel();
        $this->data['sliderImages'] = $slider->getSlider();

        return view('pages.admin.deleteSlider', $this->data);
    }

    public function deleteSlider($id)
    {
        $this->admin->deleteSlider($id);
        return redirect()->back()->with('message', 'Uspešno ste obrisali sliku slajdera!');
    }

    public function showDeleteCommentForm()
    {
        $comments = new CommentModel();
        $this->data['comments'] = $comments->getAllComments();

        return view('pages.admin.deleteComment', $this->data);
    }

    public function deleteComment($id)
    {
        $this->admin->deleteComment($id);
        return redirect()->back()->with('message', 'Uspešno ste obrisali komentar!');
    }

    public function showDeleteLinkForm()
    {
        $links = new MenuModel();
        $this->data['links'] = $links->getMenu();

        return view('pages.admin.deleteLink', $this->data);
    }

    public function deleteLink($id)
    {
        $this->admin->deleteLink($id);
        return redirect()->back()->with('message', 'Uspešno ste obrisali link!');
    }

    public function showDeleteKitchenForm()
    {
        $kitchens = new KitchensModel();
        $this->data['kitchens'] = $kitchens->getKitchen();

        return view('pages.admin.deleteKitchen', $this->data);
    }

    public function deleteKitchen($id)
    {
        $this->admin->deleteKitchen($id);
        return redirect()->back()->with('message', 'Uspešno ste obrisali kuhinju');
    }

}