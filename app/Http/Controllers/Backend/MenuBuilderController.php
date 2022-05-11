<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;

class MenuBuilderController extends Controller
{
    public function index($id){
        Gate::authorize('admin.menus.index');
        $menu = Menu::findOrFail($id);
        return view('backend.pages.menus.builder', compact('menu'));
    }

    public function order(Request $request, $id){
        Gate::authorize('admin.menus.index');
        $menuItemOrder = json_decode($request->get('order'));
        $this->orderMenu($menuItemOrder, null);
    }

    private function orderMenu(array $menuItems, $parentId){
        foreach($menuItems as $index => $item){
            $menuItem = MenuItem::findOrFail($item->id);
            $menuItem->update([
                'order' => $index + 1,
                'parent_id' => $parentId,
            ]);

            if (isset($item->children)) {
                $this->orderMenu($item->children, $menuItem->id);
            }
        }
    }

    public function itemCreate($id){
        Gate::authorize('admin.menus.create');
        $menu = Menu::findOrFail($id);
        return view('backend.pages.menus.item.create', compact('menu'));
    }

    public function itemStore(Request $request, $id){
        Gate::authorize('admin.menus.edit');
        $request->validate([
            'type' => 'required|string',
            'divider_title' => 'nullable:string',        
            'title' => 'nullable|string|unique:menu_items',
            'url' => 'nullable|string|unique:menu_items',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);
        $menu = Menu::findOrFail($id);
        MenuItem::create([
            'menu_id' => $menu->id,
            'type' => $request->type,
            'title' => $request->title,
            'divider_title' => $request->divider_title,
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class
        ]);
        Toastr::success('Successfully Item Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.menus.builder',$menu->id);
    }

    public function itemEdit($id, $itemId){
        Gate::authorize('admin.menus.edit');
        $menu = Menu::findOrFail($id);
        $menuItem = MenuItem::where('menu_id', $menu->id)->findOrFail($itemId);
        return view('backend.pages.menus.item.edit',compact('menu','menuItem'));
    }

    public function itemUpdate(Request $request, $id, $itemId){
        Gate::authorize('admin.menus.edit');
        $request->validate([
            'type' => 'required|string',
            'divider_title' => 'nullable:string',        
            'title' => 'nullable|string|unique:menu_items,title,'.$itemId,
            'url' => 'nullable|string|unique:menu_items,url,'.$itemId,
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);
        $menu = Menu::findOrFail($id);
        $menuItem = MenuItem::where('menu_id', $menu->id)->findOrFail($itemId)->update([
            'menu_id' => $menu->id,
            'type' => $request->type,
            'title' => $request->title,
            'divider_title' => $request->divider_title,
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class
        ]);
        Toastr::success('Successfully Item Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.menus.builder',$menu->id);
    }

    public function itemDestroy($id,$itemId){
        Gate::authorize('admin.menus.destroy');
        Menu::findOrFail($id)
        ->menuItems()
        ->findOrFail($itemId)
        ->delete();
        Toastr::success('Successfully Item Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
