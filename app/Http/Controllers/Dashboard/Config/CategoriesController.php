<?php
namespace Education\Http\Controllers\Dashboard\Config;

use Education\Http\Controllers\SimpleResourceController;
use Education\Repositories\CategoryRepository;
use Education\Http\Requests\Categories\CreateRequest;
use Education\Http\Requests\Categories\EditRequest;
use Education\Entities\Category;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends SimpleResourceController
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create()
    {
        $formData = $this->getFormData('store', 'POST');

        return $this->getFormView(new Category(), $formData);
    }

    public function store(CreateRequest $request)
    {
        $category = $this->categoryRepository->createForUser(Auth::user(), $request->all());
        $this->resourceFlash($category->name, 'store');

        $this->resourceRedirect('index');
    }

    public function show(Category $category)
    {
        $this->resourceView('show')->with([
            'category' => $category
        ]);
    }

    public function edit(Category $category)
    {
        $formData = $this->getFormData('store', 'POST', true);

        return $this->getFormView($category, $formData);
    }

    public function update(EditRequest $request, Category $category)
    {
        $this->categoryRepository->simpleUpdate($category, $request->all());
        $this->resourceFlash($category->name, 'store');

        return $this->resourceRedirect('index');
    }

    public function destroy(Category $category)
    {
        $success = $this->categoryRepository->deleteEntity($category);

        return $this->resourceDeleteJson($category->name, $success);
    }

    protected function getResourceEntity()
    {
        return Category::class;
    }
}
