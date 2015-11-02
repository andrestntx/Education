<?php namespace LaravelAppUi\Entities;

use Illuminate\Database\Eloquent\Model; 
	/**
	* 
	*/
	class UserType extends Model
	{
		protected $table = 'user_types';
		public $timestamp = true;
		protected $fillable = ['name', 'description', 'can_view_all'];

		/*Querys*/
		public static function allPaginate($number_pages = 10)
	    {
	        return self::with('modules')->orderBy('updated_at')->paginate($number_pages);
	    }

	    public static function allLists()
	    {
	        return self::lists('name', 'id')->all();
	    }

	    public function getModuleIdsAttribute()
	    {
	        return $this->modules()->lists('id')->all();
	    }

		public function getActiveModules()
	    {
	    	return $this->modules->filter(function($module)
	        {
	            return $module->active;
	        });
	    }

		public function getModuleNames()
	    {
	        return $this->getActiveModules()->lists('name');
	    }

	    public function getMenuModules()
	    {
	        return $this->modules()->ofMenu()->get();
	    }

	    public function getSubmenuModules($moduleName)
		{
		    return $this->load('modules.superiorModule')->modules->filter(function($module) use ($moduleName)
	        {
	            return $module->ofSuperior($moduleName) && $module->active;
	        });
		}

		public function hasModule($module)
		{
		    if(in_array($module, $this->getModuleNames()->toArray()))
		    {
		        return true;
		    }

		    return false;
		}


	    public function fillAndSave($data)
	    {
            $this->fill($data);

            if(array_key_exists('can_view_all', $data))
	        {
	            $this->can_view_all = 1;
	        }
	        else
	        {
	            $this->can_view_all = 0;
	        }

            $this->save();

            if(array_key_exists('modules', $data))
            {
                $this->modules()->sync($data['modules']);
            }
	    }

	    public function getCanViewAllTextAttribute()
	    {
	    	if($this->can_view_all == 1)
	    	{
	    		return 'Si';
	    	}

	    	return 'No';
	    }

	    /* Relations */
		public function modules()
	    {
	        return $this->belongsToMany('LaravelAppUi\Entities\Module', 'user_types_has_modules', 'user_type_id', 'module_id');
	    }
	}
 ?>