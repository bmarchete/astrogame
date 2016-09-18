@section('javascript')
  <script>
  ////////////////////////////////// montar telescópio
  var game = new Phaser.Game('100', '100', Phaser.AUTO, 'game', { preload: preload, create: create, update: update, render: render }, '#game', null, false);

  function preload() {

      game.load.image('buscador', '{{ asset('img/items/buscador.png') }}');
      game.load.image('portaocular', '{{ asset('img/items/portaocular.png') }}');
      game.load.image('tripe', '{{ asset('img/items/tripe.png') }}');
      game.load.image('tubo_telescopico', '{{ asset('img/items/tubo-telescopico.png') }}');
      game.load.image('completo', '{{ asset('img/quests/telescopio_completo.jpg')}}');

  }

  var result = 'Drag a sprite';

  function create() {
      game.physics.startSystem(Phaser.Physics.ARCADE);
      colision1 = new Phaser.Rectangle(0, 550, 800, 50);

      var group = game.add.group();

      group.inputEnableChildren = true;

      tripe = group.create(32, 100, 'tripe');
      game.physics.enable(tripe, Phaser.Physics.ARCADE);
      tripe.body.checkCollision.up = false;
      tripe.body.checkCollision.down = false;

      //  Enable input and allow for dragging
      tripe.inputEnabled = true;
      tripe.input.enableDrag();
      tripe.events.onDragStart.add(onDragStart, this);
      tripe.events.onDragStop.add(onDragStop, this);

      var tubo_telescopico = group.create(300, 200, 'tubo_telescopico');

      //  Enable input and allow for dragging
      tubo_telescopico.inputEnabled = true;
      tubo_telescopico.input.enableDrag();
      tubo_telescopico.events.onDragStart.add(onDragStart, this);
      tubo_telescopico.events.onDragStop.add(onDragStop, this);

      group.onChildInputDown.add(onDown, this);

  }

  function onDown(sprite, pointer) {

      result = "Down " + sprite.key;

      console.log('down', sprite.key);

  }

  function onDragStart(sprite, pointer) {

      result = "Dragging " + sprite.key;
      this.game.canvas.style.cursor = "move";
  }

  function onDragStop(sprite, pointer) {
      this.game.canvas.style.cursor = "default";
      result = sprite.key + " dropped at x:" + pointer.x + " y: " + pointer.y;
  }

  function update() {
    game.physics.arcade.collide(tripe, colision1);
  }

  function render() {

      game.debug.text(result, 10, 20);
      game.debug.geom(colision1,'#0fffff');
  }


  </script>

@endsection
