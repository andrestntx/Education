<?php namespace Education\Http\Controllers\Dashboard;

use Education\Entities\Protocol;
use Education\Entities\User;
use Education\Entities\Exam;
use Education\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

	class ExamsController extends Controller
	{
		public function studyProtocol($protocol_id)
		{
			$protocol = Protocol::findOrFail($protocol_id);
			$user = Auth::user();
			return view()->make('dashboard.pages.companies.users.protocols.study', compact('protocol', 'user'));
		}

		public function create($protocol_id)
		{
			$protocol = Protocol::findOrFail($protocol_id);
			
			if( ! $protocol->aviable)
			{
				abort('404');
			}
			
			$protocol->load('questions');
			$exam = new Exam(['user_id' => Auth::user()->id, 'protocol_id' => $protocol_id]);
			$form_data = ['route' => ['exams.store', $protocol->id], 'method' => 'POST'];

			return view('dashboard.pages.companies.users.protocols.exams.form', compact('protocol', 'exam', 'form_data'));
			
		}

		public function store(Request $request, $protocol_id)
		{
			$protocol = Protocol::findOrFail($protocol_id);
			$data = Input::only('answers');
			$exam = ResolvedSurvey::create(array('survey_id' => $protocol->survey_id, 'user_id' => Auth::user()->id));
			$exam->answers()->attach($data['answers']);
			return Redirect::to('/');
		}
	}
 ?>