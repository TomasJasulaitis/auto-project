<?php

namespace App\Forms;

use App\Rules\MinWordsRule;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class TruckForm extends Form
{
    public function buildForm()
    {
        $choices = \App\TruckModel::all()->pluck('title', 'id')->toArray();

        $this
            ->add('model', Field::SELECT, [
                'rules' => 'required',
                'choices' => $choices,
            ])
            ->add('manufacture_date', Field::NUMBER, [
                'rules' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            ])
            ->add('full_name', Field::TEXT, [
                'rules' => ['required', new MinWordsRule(2)],
            ])
            ->add('owner_count', Field::NUMBER)
            ->add('comments', Field::TEXTAREA)
            ->add('submit', Field::BUTTON_SUBMIT);
    }
}
