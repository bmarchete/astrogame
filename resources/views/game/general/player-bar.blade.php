<div id="player-bar">
	<div class="uk-grid uk-container uk-container-center uk-text-center uk-margin-top uk-align-center">
		<div class="uk-width-4-10 uk-width-large-1-10">
			<button class="uk-close uk-close-alt" data-uk-toggle="{target:'#player-bar', animation:'uk-animation-slide-bottom'}"></button>
			<a href="#" class="volume uk-icon-small uk-close-alt uk-icon-cog" style="color: #333" data-uk-modal="{target:'#settings'}" data-uk-tooltip title="{{ trans('game.config') }}"></a>
		</div>

		<div class="uk-width-6-10 uk-width-large-8-10">
			<div class="uk-progress uk-progress-success">
		    	<div class="uk-progress-bar" style="width: {{ App\User::xp_bar() }}%;" data-uk-tooltip title="{{ App\User::xp_bar() }} ({{ \Auth::user()->xp }} XP)">Level {{ \Auth::user()->level }} - falta 12.0000</div>
			</div>
		</div>	

		<div class="uk-width-1-2 uk-width-large-1-10">
	    	<figure class="uk-thumbnail uk-border-circle">
	    		<img src="img/avatar.png" alt="foto avatar" class="uk-border-circle avatar" data-uk-tooltip title="Astronauta {{ \Auth::user()->name }}">
			</figure>
		</div>

		<div class="uk-width-1-1 uk-width-large-2-10">
			<h2>Missões <span class="uk-badge uk-badge-warning">!</span></h2>
    		<div class="uk-button-group">
    		    <button class="uk-button uk-button-danger"><i class="uk-icon-rocket"></i> Campanha</button>
    		    <button class="uk-button uk-button-success"><i class="uk-icon-space-shuttle"></i> Exploração</button>
    		</div>
		</div>

	</div>
</div>

<!-- settings modal -->
<div id="settings" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>
        <h2>{{ trans('game.config') }}</h2>
        <form class="uk-form">
             <div class="uk-form-row">
                <div class="uk-form-controls">
                    <label class="uk-form-label" for="enable-sound">
                    	<i class="uk-icon-volume-off"></i>
                    	<input id="volume-sound" type="range" min="0" max="100" value="50"> <i class="uk-icon-volume-up"></i> {{ trans('game.volume-sound') }}
                    </label>
                </div>
            </div>

            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <label class="uk-form-label" for="enable-music">
                    	<i class="uk-icon-volume-off"></i>
                    	<input id="volume-music" type="range" min="0" max="100" value="25"> <i class="uk-icon-music"></i> {{ trans('game.volume-music') }}
                    </label>
                </div>
            </div>

            <div class="uk-form-row">
            	<div class="uk-form-controls">
            			<div class="uk-form-select" data-uk-form-select>
            			    <span>{{ trans('game.lang') }}: </span>
            			    <select name="lang">
            			        <option value="pt-br">Português Brasileiro</option>
            			        <option value="en">English</option>
            			    </select>
            			</div>
            	</div>
            </div>

             <div class="uk-form-row">
                <div class="uk-form-controls">
                    <label class="uk-form-label" for="enable-cursos">
                    	<input type="checkbox" name="cursor"> 
                    	<i class="uk-icon-mouse-pointer"></i> {{ trans('game.cursor') }}
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>