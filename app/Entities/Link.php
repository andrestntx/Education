<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	protected $table = 'annexes';
	protected $fillable = ['name', 'description', 'protocol_id'];
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public function getUserValueAttribute()
    {
        return $this->user->name;
    }

    public function protocol()
    {
        return $this->belongsTo(Protocol::class);
    }

    public function isValidFile($file)
    {
        if(!is_null($file) && !$file->isValid())
        {
            $this->errors = array('El Archivo debe ser menor que '.ini_get('upload_max_filesize'));
            echo " el archivo falla ";
            return false;
        }

        return true;
    }

	public function isValid($data)
    {
        $rules = array(
            'name'     => 'required|max:100|unique:annex',
            'protocol_id' => 'required',
            'url' => 'mimes:jpeg,bmp,png,mp4,pdf|max:1500'
        );

        if ($this->exists)
        {
			$rules['name'] .= ',name,'.$this->id.',id';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        return false;
    }

    public function isValidLink($data)
    {
        $rules = array(
            'name'     => 'required|max:100|unique:annex',
            'protocol_id' => 'required',
            'url' => 'required'
        );

        if ($this->exists)
        {
            $rules['name'] .= ',name,'.$this->id.',id';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        return false;
    }

    public function validAndSave($data, $file)
    {
        if ($this->isValid($data) && $this->isValidFile($file))
        {
            $this->fill($data);
            $this->save();
            $this->uploadFile($file);
            
            return true;
        }
        
        return false;
    }

    public function validAndSaveLink($data)
    {
        if ($this->isValidLink($data))
        {
            $this->fill($data);
            $this->url = $data['url'];
            $this->save();
            
            return true;
        }
        
        return false;
    }

    public function uploadFile($file)
    {
        if(File::isFile($file))
        {
            $path = Config::get('constant.path_annex');
            $name = $this->id.'.'.$file->getClientOriginalExtension();
            $url = $path.'/'.$name;
            $file->move($path, $name);
            $this->url = $url;
            $this->save();
        }
    }

    public function getTypeAttribute()
    {
        $extension = File::extension($this->url);
        if($extension == 'png' || $extension == 'jpg' || $extension == 'bmp')
        {
            return 'image';
        }
        else if($extension == 'mp4')
        {
            return 'video';
        }
        else if($extension == 'pdf')
        {
            return 'pdf';
        }
        else if($extension == '' || $extension == 'com')
        {
            return 'link';
        }

        return 'other';
    }

    public function isImage()
    {
        if($this->type == 'image')
        {
            return true;
        }

        return false;
    }

    public function isPdf()
    {
        if($this->type == 'pdf')
        {
            return true;
        }

        return false;
    }

    public function isVideo()
    {
        if($this->type == 'video')
        {
            return true;
        }

        return false;
    }

    public function isLink()
    {
        if($this->type == 'link')
        {
            return true;
        }

        return false;
    }

    public function isLinkYoutube()
    {
        if($this->type == 'link' &&  strpos($this->url, 'www.youtube.com'))
        {
            return true;
        }

        return false;
    }

    public function getIdLinkYoutubeAttribute()
    {
        if($this->isLinkYoutube())
        {
            $partes = explode("=", $this->url);
            return $partes[1];
        }
        
    }

    public function isFile()
    {
        if(!$this->isLink())
        {
            return true;
        }

        return false;
    }

    public function getIconAttribute()
    {
        if($this->isFile())
        {
            if($this->isImage())
            {
                return 'fa fa-picture-o';
            }
            else if($this->isPdf())
            {
                return 'fa fa-file-text'; 
            }
            else if($this->isVideo())
            {
                return 'fa fa-film'; 
            }
            else
            {
                return 'fa fa-download';
            }
            
        }
        else if($this->isLink())
        {
            return 'fa fa-share';
        }
    }
}
