<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>
<?php /** @var \Galahad\Aire\Support\OptionsCollection $options */ ?>

<fieldset>
  <span class="radio radio--inline">

	@isset($prepend_empty_option)
		<span>
		<label {{ $attributes->label }}>
			<input
					{{ $attributes->except('id', 'value', 'checked') }}
					value="{{ $prepend_empty_option->value }}"
					{{ $attributes->isValue($prepend_empty_option->value) ? 'checked' : '' }}
			/>
			<span {{ $attributes->label_wrapper }}>
				{{ $prepend_empty_option->label }}
			</span>
		</label>
		</span>
	@endisset
	
	@foreach($options->getOptions() as $option_value => $option_label)
		<span>
			<input id="{{ $option_value }}" 
					{{ $attributes->except('id', 'value', 'checked') }}
					value="{{ $option_value }}"
					{{ $attributes->isValue($option_value) ? 'checked' : '' }}
				/>
			<label {{ $attributes->label }} for="{{ $option_value }}">
				
				<span {{ $attributes->label_wrapper }}>
					{{ $option_label }}
				</span>
			</label>
		</span>
	@endforeach
  </span>
</fieldset>