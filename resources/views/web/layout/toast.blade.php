@if (session('message'))
	<?php $message = session('message');?>
    <script type="text/javascript">
        @switch($message['type'])
			@case('success')
				toastr.success("{{ $message['content'] }}");
				@break

			@case('error')
				toastr.error("{{ $message['content'] }}");
				@break

			@default
				toastr.info("{{ $message['content'] }}");
        @endswitch
    </script>
@endif
@if($errors->any())
	@foreach ($errors->all() as $error)
		<script type="text/javascript">
			toastr.error("{{$error}}");
		</script>
	@endforeach
@endif