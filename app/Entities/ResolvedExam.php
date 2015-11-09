<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class ResolvedExam extends Model
{
	protected $fillable = array('name', 'description', 'survey_id', 'user_id');
	public $timestamps = true;
	public $increments = true;

    public function survey()
    {
        return $this->belongsTo('Survey', 'survey_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function answers()
    {
        return $this->belongsToMany('Answer', 'resolved_survey_has_answer', 'resolved_survey_id', 'answer_id');
    }

    public function validAndSave($survey_id, $user, $multipleAnswers = null, $simpleAnswers = null)
    {
        $this->survey_id = $survey_id;
        $this->user_id = $user->id;
        $this->save();

        if(!is_null($simpleAnswers))
        {
            foreach ($simpleAnswers as $question_id => $text) 
            {
                $newAnswers[$question_id] = new Answer(array('question_id' => $question_id, 'text' => $text));
            }  
            $this->answers()->saveMany($newAnswers);
        }
        
        if(!is_null($multipleAnswers))
        {
            $this->answers()->attach($multipleAnswers);    
        }

        //$this->sendViaEmail($user);
    }

    public function sendViaEmail($user)
    {
        $this->generatePdf();

        $company = $user->preferredCompany;
        $company_logo = $company->logo;
        $company_name = $company->name;

        $survey_name = $this->survey->name;
        $pdf_path = $this->pdf;

        Mail::queue('emails.forms.new', compact('company_logo', 'company_name', 'survey_name', 'pdf_path'), function($message) use ($pdf_path, $user) {
            $message->to($user->email, $user->name)->subject('Haz realizado un registro de Formulario');
            $message->attach($pdf_path);
        }); 

                 
    }

    public function getPdfAttribute()
    {
        return Config::get('constant.path_forms_pdf').'/'.$this->id.'.pdf';
    }

    public function generatePdf()
    {
        $resolvedSurvey = $this;
        $survey = $this->survey;

        $pdf = PDF::loadView('dashboard.pages.resolvedsurvey.export', compact('survey', 'resolvedSurvey'))->save($this->pdf);
        return $pdf;
    }

}


?>