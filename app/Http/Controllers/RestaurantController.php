<?php


namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class RestaurantController extends FrontendController
{
    public function showRestaurantIndex()
    {
        $infos = $this->restaurant->getLoggedRestaurant();
        return view('pages.restaurantAdmin.restaurantIndex', $this->data, ["infos" => $infos]);
    }

    public function showRestaurantComments()
    {
        $id = session()->get('restaurant')->id;
        $this->data['comments'] = $this->restaurant->getRestaurantComments($id);
        $comments_number = $this->restaurant->getCommentsNumber($id);

        return view('pages.restaurantAdmin.comments', $this->data,
            [
                "commentsNumber" => $comments_number
            ]);
    }
    public function showRestaurantJobs()
    {
        $id = session()->get('restaurant')->id;
        $this->data['jobs'] = $this->restaurant->getRestaurantJobs($id);
        $jobs_number = $this->restaurant->getJobsNumber($id);

        return view('pages.restaurantAdmin.jobs', $this->data,
            [
                "jobsNumber" => $jobs_number
            ]);
    }
    public function showRestaurantApplicants()
    {
        $this->data['applicants'] = $this->restaurant->getApplicants();
        $applicantNumber = $this->restaurant->getApplicantsNumber();

        return view('pages.restaurantAdmin.applicants', $this->data,
            [
                "applicantsNumber" => $applicantNumber
            ]);
    }

    public function showRestaurantJobApplicants($id)
    {
        $this->data['applicants'] = $this->restaurant->getOneJobApplicants($id);
        $applicantNumber = $this->restaurant->getJobApplicantsNumber($id);
        $position = $this->restaurant->getApplicantsPosition($id);
//        dd($position);

        return view('pages.restaurantAdmin.oneJobApplicants', $this->data,
            [
                "applicantsNumber" => $applicantNumber,
                "position" => $position
            ]);
    }

    public function showOrders()
    {
        $orders = $this->restaurant->getOrders();

        $orders->transform(function ($order){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        return view('pages.restaurantAdmin.orders', $this->data,
            [
                'orders' => $orders
            ]);
    }

    public function showInsertProductForm()
    {
        $this->data['categories'] = $this->restaurant->getRestaurantCategories();

        return view('pages.restaurantAdmin.insertProduct', $this->data);
    }

    public function insertProduct(\App\Http\Requests\InsertProduct $request)
    {
        $this->product->name = $request->input('productName');
        $this->product->price = $request->input('productPrice');
        $this->product->description = $request->input('productDescription');
        $this->product->grams = $request->input('productGrams');
        $category = $this->product->category = $request->input('productCategory');

        $image = $request->file('productImage');

        $tmp_path = $image->getPathName();
        $extension = $image->getClientOriginalExtension();
        $file_name = time() . '.' .$extension;

        $this->product->img = $path = './img/'.$file_name;

        if ($category == 0){
            return redirect()->back()->with('message', 'Morate izabrati kategoriju');
        }

        if($image->isValid())
        {
            File::move($tmp_path, $path);
            $this->product->insertProduct();

            return redirect()->back()->with('message', 'Uspešno ste dodali proizvod');
        }
        else{
            return redirect()->back()->with('message', 'Greška!');
        }
    }

    public function showInsertJobForm()
    {
        return view('pages.restaurantAdmin.insertJob', $this->data);
    }

    public function insertJob(\App\Http\Requests\InsertJob $request)
    {
        $this->job->jobTitle = $request->input('jobName');
        $this->job->requirements = $request->input('requirements');
        $this->job->offer = $request->input('offer');
        $this->job->wage = $request->input('wage');
        $this->job->description = $request->input('description');

        try
        {
            $this->job->addJob();
            return redirect()->back()->with('message','Uspešno ste postavili oglas za posao');
        }
        catch (QueryException $exception)
        {
            Log::info("Neuspešno dodavanje posla!" .$exception->getMessage());
            return redirect()->back()->with('message', 'Greška pri dodavanju oglasa za posao');
        }
    }

    public function showDeleteProductForm()
    {
        $this->data['products'] = $this->product->getAllRestaurantProducts();
        return view('pages.restaurantAdmin.deleteProduct', $this->data);
    }

    public function deleteProduct($id)
    {
        $this->product->delete($id);
        return redirect()->back()->with('message','Uspešno ste obrisali proizvod!');
    }

    public function showDeleteJobForm()
    {
        $this->data['jobs'] = $this->job->getAllRestaurantJobs();
        return view('pages.restaurantAdmin.deleteJob', $this->data);
    }

    public function deleteJob($id)
    {
        $this->job->deleteJob($id);
        return redirect()->back()->with('message','Uspešno ste obrisali posao!');
    }

    public function showUpdateProductTable()
    {
        $this->data['products'] = $this->product->getAllRestaurantProducts();
        return view('pages.restaurantAdmin.updateProducts', $this->data);
    }

    public function showUpdateProductForm($id)
    {
        $this->data['categories'] = $this->restaurant->getRestaurantCategories();
        $updateProduct = $this->product->getSingleProduct($id);
        return view('pages.restaurantAdmin.updateProductFinalForm', $this->data,
            [
                "updateProduct" => $updateProduct
            ]);
    }

    public function updateProduct(Request $request, $id)
    {
        $updateProduct = $this->product->getSingleProduct($id);

        $this->product->name = $request->input('newProductName');
        $this->product->price = $request->input('newProductPrice');
        $this->product->description = $request->input('newProductDescription');
        $this->product->grams = $request->input('newProductGrams');
        $this->product->category = $request->input('newProductCategory');

        $image = $request->file('newProductImage');

        if ($image == null)
        {
            $this->product->img = $updateProduct->img;
            $this->product->updateProduct($id);

            return redirect('/restaurant/update-product')->with('message', 'Uspešno ste promenili proizvod');
        }
        else {
            $tmp_path = $image->getPathName();
            $extension = $image->getClientOriginalExtension();
            $file_name = time() . '.' . $extension;

            $this->product->img = $path = './img/' . $file_name;

            if($image->isValid())
            {
                File::move($tmp_path, $path);
                $this->product->updateProduct($id);

                return redirect('/restaurant/update-product')->with('message', 'Uspešno ste promenili proizvod');
            }
            else {
                return redirect()->back()->with('message', 'Greška pri promeni proizvoda!');
            }
        }
    }

    public function showUpdateJobTable()
    {
        $this->data['jobs'] = $this->job->getAllRestaurantJobs();

        return view('pages.restaurantAdmin.updateJobs', $this->data);
    }

    public function showUpdateJobForm($id)
    {
        $updateJob = $this->job->getSingleJob($id);

        return view('pages.restaurantAdmin.updateJobFinalForm', $this->data,
            [
                "updateJob" => $updateJob
            ]);

    }

    public function updateJob(Request $request, $id)
    {
        $this->job->wage = $request->input('newWage');

        try{
            $this->job->updateJob($id);

            return redirect('/restaurant/update-job-info')->with('message', 'Uspešno ste promenili informaciju oglasa');
        }catch (QueryException $exception){
            Log::info("Neuspešno dodavanje posla!" .$exception->getMessage());

            return redirect()->back()->with('message', 'Greška pri dodavanju oglasa za posao');
        }
    }

    public function showInfoUpdateForm()
    {
        return view('pages.restaurantAdmin.updateInfo', $this->data);
    }

    public function updateInfo(Request $request)
    {
        $updateRestaurant = $this->restaurant->getLoggedRestaurant();

        $this->restaurant->restaurantName = $request->input('newRestaurantName');
        $this->restaurant->price_delivery = $request->input('newDeliveryPrice');
        $this->restaurant->description = $request->input('newRestaurantDescription');
        $this->restaurant->min_delivery = $request->input('newMin');
        $this->restaurant->time_delivery = $request->input('newTime');
        $this->restaurant->location = $request->input('newLocation');

        $image = $request->file('newRestaurantProfilePic');
//        dd($image);

        if ($image == null)
        {
            $this->restaurant->img = $updateRestaurant->profile_pic;
//            dd($this->restaurant->img);
            $this->restaurant->updateInfo();

            return redirect('/restaurant-profile')->with('message', 'Uspešno ste promenili podatke');
        }
        else {
//            dd($image);
            $tmp_path = $image->getPathName();
            $extension = $image->getClientOriginalExtension();
            $file_name = time() . '.' . $extension;
//            dd($file_name);
            $this->restaurant->img = $path = './img/' . $file_name;
//            dd($this->)
            if($image->isValid())
            {
                File::move($tmp_path, $path);

                $this->restaurant->updateInfo();

                return redirect('/restaurant-profile')->with('message', 'Uspešno ste promenili podatke');
            }
            else{
                return redirect()->back()->with('message', 'Greška pri promeni podataka restorana!');
            }
        }
    }
}