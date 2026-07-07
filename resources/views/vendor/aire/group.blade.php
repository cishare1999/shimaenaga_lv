<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>


<div {{ $attributes }}>
	<div class="Form-Item">
	  <p class="Form-Item-Label">
	    {{ $label }}
	    @if($prepend == '必須')
				<span class="Form-Item-Label-Required">必須</span>
			@endif
		</p>
	  {{ $element }}
	</div>

	@if($append)
		<div {{ $attributes->append }}>
			{{ $append }}
		</div>
	@endif

	<!--
	<ul {{ $attributes->errors }}>
		@each($error_view, $errors, 'error')
	</ul>
	-->
	
	@isset($help_text)
		<small {{ $attributes->help_text }}>
			{{ $help_text }}
		</small>
	@endisset
</div>