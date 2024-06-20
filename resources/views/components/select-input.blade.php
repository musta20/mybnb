@props(['disabled' => false,
'selected' => null,
'options' => []])

<select
 {{ $disabled ? 'disabled' : '' }}
 {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
 <option  selected  value=""> -- اختر من القائمة -- </option>

 @foreach ($options as $key => $value)
        
 @if ($options instanceof  Illuminate\Support\Collection )
 <option @if ($selected == $value->id) selected @endif value="{{ $value->id }}">{{ __($value->name ?? $value->title) }}</option>

 @else
 <option @if ($selected == $value->value) selected @endif value="{{ $value->value  }}">{{ __('messages.'.$value->name) }}</option>

 @endif
 @endforeach
</select>
