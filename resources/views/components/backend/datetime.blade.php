<input type="text" name="{{$name}}" id="input-{{$name}}" value="{{$value ?? ''}}" class="form-control" required>
<script>
window.onload = function () {
    flatpickr("#input-{{$name}}", {
        enableTime: true,
        dateFormat: "Y-m-d H:i"
    });
}
</script>