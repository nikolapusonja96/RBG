<?php


namespace App\Http\Controllers;

use App\Http\Models\CategoriesModel;
use App\Http\Models\KitchensModel;
use App\Http\Models\ProductModel;
use App\Http\Models\SliderModel;

class FrontendController extends BaseController
{
    public function showHome()
    {
        $slider = new SliderModel();

        $this->data['latest_jobs'] = $this->job->getLatestJobs();
        $this->data['sliderImages'] = $slider->getBigSlider();
        $this->data['latest_restaurants'] = $this->restaurant->getLatestRestaurants();
        $this->data['top_restaurants'] = $this->restaurant->getTopLikedRestaurants();

        return view('pages.index', $this->data);
    }
    public function showAuthor()
    {
        return view('pages.author', $this->data);
    }

    public function showAbout()
    {
        $slider = new SliderModel();

        $this->data['smallSlider'] = $slider->getSmallSlider();
        return view('pages.about', $this->data);
    }

    //restaurants
    public function showRestaurants()
    {
        $kitchens = new KitchensModel();
        $this->data['restaurants'] = $this->restaurant->getRestaurants();
        $this->data['kitchens'] = $kitchens->getKitchen();

        return view('pages.restaurants', $this->data);
    }

    public function showSingleRestaurant($id)
    {
        $categories = new CategoriesModel();

        $this->data['categories'] = $categories->getRestaurantCategories($id);
        $this->data['products'] = $this->restaurant->getRestaurantProducts($id);
        $this->data['jobs'] = $this->restaurant->getRestaurantJobs($id);
        $this->data['comments'] = $this->restaurant->getRestaurantComments($id);

        $job_number = $this->restaurant->getJobsNumber($id);
        $comments_number = $this->restaurant->getCommentsNumber($id);

        if(session()->has('user')) {
            $like = $this->restaurant->getLikedRestaurant($id);
        }

        $likes = $this->restaurant->getRestaurantLikes($id);

        if (session()->has('user')) {
            return view('pages.singleRestaurant', $this->data,
                [
                    "jobs_number" => $job_number,
                    "comments_number" => $comments_number,
                    "like" => $like,
                    "likes" => $likes
                ]);
        }
        else{
            return view('pages.singleRestaurant', $this->data,
                [
                    "jobs_number" => $job_number,
                    "comments_number" => $comments_number,
                    "likes" => $likes
                ]);
        }
    }

    public function showProductsCategory($idRestaurant, $idCategory)
    {
        $categories = new CategoriesModel();

        $this->data['categories'] = $categories->getRestaurantCategories($idRestaurant);
        $this->data['products_category'] = $this->product->getCategoryProducts($idRestaurant, $idCategory);
        $this->data['products'] = $this->restaurant->getRestaurantProducts($idRestaurant);
        $this->data['jobs'] = $this->restaurant->getRestaurantJobs($idRestaurant);
        $this->data['comments'] = $this->restaurant->getRestaurantComments($idRestaurant);

        $job_number = $this->restaurant->getJobsNumber($idRestaurant);
        $comments_number = $this->restaurant->getCommentsNumber($idRestaurant);

        if(session()->has('user')) {
            $like = $this->restaurant->getLikedRestaurant($idRestaurant);
        }

        $likes = $this->restaurant->getRestaurantLikes($idRestaurant);

        if (session()->has('user')) {
            return view('pages.productsCategory', $this->data,
                [
                    "jobs_number" => $job_number,
                    "comments_number" => $comments_number,
                    "like" => $like,
                    "likes" => $likes
                ]);
        }
        else{
            return view('pages.productsCategory', $this->data,
                [
                    "jobs_number" => $job_number,
                    "comments_number" => $comments_number,
                    "likes" => $likes
                ]);
        }
    }

    //jobs

    public function showJobs()
    {
        $this->data['jobs'] = $this->job->getJobs();

        $job = $this->job->getNewestJob();

        return view('pages.jobs', $this->data, ["job" => $job]);
    }

    public function showSingleJob($id)
    {
        $this->data['job'] = $this->job->getSingleJob($id);

        if (session()->has('user')) {
            $userSingleJob = $this->job->getUserSingleJob($id);

            return view('pages.singleJob',
                [
                    "userSingleJob" => $userSingleJob
                ], $this->data);
        }
        else{
            return view('pages.singleJob', $this->data);
        }
    }

    public function addApplicant($id)
    {
        $this->job->addApplicant($id);
        return redirect()->back()->with('message', 'Uspesno ste konkurisali za posao');
    }

    public function addLike($id)
    {
        $restaurant = $this->restaurant->getSingleRestaurant($id);
        $old_likes = $restaurant->likes;

        $this->restaurant->newLikes = $old_likes + 1;
        $this->restaurant->addLike($id);

        return redirect()->back()->with('message', 'Uspesno ste lajkovali restoran');
    }

    public function showKitchenRestaurant($id)
    {
        $kitchen = new KitchensModel();

        $this->data['kitchens'] = $kitchen->getKitchen();
        $this->data['restaurant_kitchen'] = $kitchen->getRestaurantKitchen($id);

        if(session()->has('user')) {
            $like = $this->restaurant->getLikedRestaurant($id);
        }

        $likes = $this->restaurant->getRestaurantLikes($id);

        $job_number = $this->restaurant->getJobsNumber($id);
        $comments_number = $this->restaurant->getCommentsNumber($id);

        $this->data['jobs'] = $this->restaurant->getRestaurantJobs($id);
        $this->data['comments'] = $this->restaurant->getRestaurantComments($id);

        if (session()->has('user')) {
            return view('pages.kitchenRestaurant', $this->data,
                [
                    "jobs_number" => $job_number,
                    "comments_number" => $comments_number,
                    "like" => $like,
                    "likes" => $likes
                ]);
        }
        else{
            return view('pages.kitchenRestaurant', $this->data,
                [
                    "jobs_number" => $job_number,
                    "comments_number" => $comments_number,
                    "likes" => $likes
                ]);
        }
    }
}
