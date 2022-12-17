<div class="mailbox-read-info pt-0">
    <h5>{{ $mensaje->asunto }}</h5>
    <h6>From: <a href="mailto:{{ $mensaje->correo }}">{{ $mensaje->correo }}</a>
      <span class="mailbox-read-time float-right">{{ $mensaje->created_at }}</span></h6>
  </div>
  <!-- /.mailbox-read-info -->
  
  <!-- /.mailbox-controls -->
  <div class="mailbox-read-message pt-3">
    <p>{{ $mensaje->mensaje }}</p>
</div>