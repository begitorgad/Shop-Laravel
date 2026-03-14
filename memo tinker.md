Part 4:

use App\Models\Product;
Product::all();
count(Product::all());
Product::find(7);
Product::where('active', '1')->first();
Product::orderBy('price', 'desc')->get();
Product::orderBy('price','asc')->get()->take(5)
Product::where('price','>', 50)->get()
Product::where('category_id',1)->where('active', 1)->get()
Product::where('stock',0)->get();
Product::whereLike('name', '%ae%')->get();
Product::where('active', '1')->count();

CRUD
Product::create([
  'category_id' => 1,
  'name' => 'Test Product',
  'slug' => 'test-product',
  'description' => null,
  'price' => 9.99,
  'stock' => 10,
  'image' => null,
  'active' => true,
]);

Product::all()/Product::find(x);

$p = Product::find(x);
$p->price = xx,xx;
$p->save();

Product::find(x)->delete();
Product::find(x)->forceDelete();

Part 6:

use App\Models\Product;
Product::find(15)->category;
use App\Models\Category;
Category::find(1)->products;

use App\Models\Product;
Product::find(x)->tags()->attach(x) (return null)
attach() just attaches. detach() detaches. synch() remplaces any existing with the specified ones. synchWithoutDetach() adds any tags that wasn't already attached
$product->tagq/$tags->products





pwd=Abcdefgh1!