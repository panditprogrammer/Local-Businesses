# LocalBusiness 

# TODO

To make your `Category` model in Laravel as feature-rich as possible, you can add several methods to facilitate operations such as querying, managing hierarchical relationships, filtering, and performing other relevant tasks. Below is a comprehensive list of methods you can include in your `Category` model:

### Full `Category` Model with All Possible Methods:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'categories';

    // Define the parent-child relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Define the subcategory relationship
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Define the relationship with products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Check if the category has subcategories
    public function hasSubcategories()
    {
        return $this->subcategories()->exists();
    }

    // Scope to get categories with products (for listings)
    public function scopeWithProducts($query)
    {
        return $query->with('products');
    }

    // Get all categories with their subcategories recursively
    public function getAllCategoriesWithSubcategories($parentId = null)
    {
        $categories = Category::where('parent_id', $parentId)->get();

        foreach ($categories as $category) {
            $category->subcategories = $this->getAllCategoriesWithSubcategories($category->id);
        }

        return $categories;
    }

    // Method to list all parent categories (top-level categories)
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Method to list all subcategories (excluding the parent category)
    public function scopeSubcategories($query)
    {
        return $query->whereNotNull('parent_id');
    }

    // Get the total count of products in a category (including subcategories)
    public function getTotalProductsCountAttribute()
    {
        return $this->products()->count() + $this->subcategories->sum(function($subcategory) {
            return $subcategory->products()->count();
        });
    }

    // Get the path to all parent categories (breadcrumb-like navigation)
    public function getCategoryPath()
    {
        $path = collect();
        $currentCategory = $this;

        while ($currentCategory->parent) {
            $path->prepend($currentCategory->parent->name);
            $currentCategory = $currentCategory->parent;
        }

        return $path->push($this->name);
    }

    // Get the direct subcategories of this category
    public function getDirectSubcategories()
    {
        return $this->subcategories()->get();
    }

    // Check if this category is a subcategory of another
    public function isSubcategoryOf($categoryId)
    {
        return $this->parent_id == $categoryId;
    }

    // Recursive function to get all descendants (including subcategories of subcategories)
    public function getAllDescendants()
    {
        $descendants = $this->subcategories()->get();

        foreach ($descendants as $subcategory) {
            $descendants = $descendants->merge($subcategory->getAllDescendants());
        }

        return $descendants;
    }

    // Get all categories and their products in one query
    public function getCategoriesAndProducts()
    {
        return $this->with('products')->get();
    }

    // Check if the category has any products
    public function hasProducts()
    {
        return $this->products()->exists();
    }

    // Get the parent category of a given subcategory
    public function getParentCategory()
    {
        return $this->parent;
    }

    // Get the number of subcategories for a given category
    public function getSubcategoryCount()
    {
        return $this->subcategories()->count();
    }

    // Fetch categories along with the count of their products
    public function scopeWithProductCount($query)
    {
        return $query->withCount('products');
    }

    // Get the product count for the category as an attribute
    public function getProductCountAttribute()
    {
        return $this->products()->count();
    }

    // Method to return categories in a hierarchical format (array or collection)
    public function getCategoriesHierarchy($parentId = null)
    {
        $categories = Category::where('parent_id', $parentId)->get();
        $categoriesHierarchy = [];

        foreach ($categories as $category) {
            $subcategories = $this->getCategoriesHierarchy($category->id);
            $categoriesHierarchy[] = [
                'category' => $category,
                'subcategories' => $subcategories,
            ];
        }

        return $categoriesHierarchy;
    }

    // Method to get the name of a category and its parent categories
    public function getCategoryTreeName()
    {
        $categoryNames = [$this->name];
        $parent = $this->parent;

        while ($parent) {
            array_unshift($categoryNames, $parent->name);
            $parent = $parent->parent;
        }

        return implode(' > ', $categoryNames);
    }

    // Method to list all categories without their subcategories (flat list)
    public function getFlatCategories()
    {
        return Category::whereNull('parent_id')->get();
    }

    // Method to get all subcategories of a category with the parent category included
    public function getFullCategoryTree()
    {
        $categoryTree = $this->getCategoriesHierarchy();
        array_unshift($categoryTree, [
            'category' => $this,
            'subcategories' => [],
        ]);
        return $categoryTree;
    }
}
```

### Explanation of Methods:

1. **Relationships:**
   - `parent()`: Retrieves the parent category for a given category.
   - `subcategories()`: Retrieves all subcategories of the current category.
   - `products()`: Retrieves all products related to this category.

2. **Utility Methods:**
   - `hasSubcategories()`: Checks if a category has subcategories.
   - `hasProducts()`: Checks if a category has any products.
   - `isSubcategoryOf()`: Checks if a category is a subcategory of another category.
   - `getParentCategory()`: Returns the parent category of the current category.

3. **Hierarchical Methods:**
   - `getAllCategoriesWithSubcategories()`: Recursively retrieves all categories with their subcategories.
   - `getCategoryPath()`: Returns a breadcrumb-like array of parent categories, from the root to the current category.
   - `getDirectSubcategories()`: Retrieves the direct subcategories of the category.
   - `getAllDescendants()`: Recursively fetches all descendants (subcategories of subcategories) of a category.
   - `getCategoriesHierarchy()`: Retrieves all categories in a hierarchical structure (recursive).
   - `getCategoryTreeName()`: Returns the category name along with its parent categories in a tree format (e.g., "Electronics > Mobiles > iPhone").

4. **Product-related Methods:**
   - `getTotalProductsCountAttribute()`: Calculates the total count of products within a category, including those in its subcategories.
   - `getProductCountAttribute()`: Retrieves the count of products in the category.
   - `scopeWithProducts()`: Scope to eagerly load products along with categories.
   - `scopeWithProductCount()`: Scope to eagerly load categories with a count of their products.

5. **Flat Listing and Other Queries:**
   - `getFlatCategories()`: Returns a flat list of all categories that have no parent (top-level categories).
   - `getCategoriesAndProducts()`: Fetches categories with their associated products in one query.
   - `scopeParents()`: Filters to get only parent categories (those with no `parent_id`).
   - `scopeSubcategories()`: Filters to get only subcategories (categories that have a `parent_id`).

### How to Use These Methods:

- To get categories with their subcategories recursively:
  ```php
  $category = Category::find(1);
  $subcategories = $category->getAllCategoriesWithSubcategories();
  ```

- To get all products in a category and its subcategories:
  ```php
  $category = Category::find(1);
  $totalProducts = $category->getTotalProductsCountAttribute();
  ```

- To get a category’s breadcrumb path:
  ```php
  $category = Category::find(5);
  $path = $category->getCategoryPath();
  ```

This setup provides you with an extremely flexible and feature-rich model for managing categories and subcategories in an e-commerce application like Amazon, supporting recursive relationships and easy navigation.