<?php

namespace Thunderlabid\Inspector;

use Illuminate\Support\ServiceProvider;

use Event;

use Thunderlabid\Inspector\Events\Clamp\ClampCreating;
use Thunderlabid\Inspector\Events\Clamp\ClampUpdating;
use Thunderlabid\Inspector\Events\Clamp\ClampDeleting;

use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerCreating;
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerUpdating;
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerDeleting;

use Thunderlabid\Inspector\Events\Group\GroupCreating;
use Thunderlabid\Inspector\Events\Group\GroupUpdating;
use Thunderlabid\Inspector\Events\Group\GroupDeleting;

use Thunderlabid\Inspector\Events\Machine\MachineCreating;
use Thunderlabid\Inspector\Events\Machine\MachineCreating;
use Thunderlabid\Inspector\Events\Machine\MachineCreating;

use Thunderlabid\Inspector\Events\Scope\ScopeCreating;
use Thunderlabid\Inspector\Events\Scope\ScopeCreating;
use Thunderlabid\Inspector\Events\Scope\ScopeCreating;

use Thunderlabid\Inspector\Events\Token\TokenCreating;
use Thunderlabid\Inspector\Events\Token\TokenCreating;
use Thunderlabid\Inspector\Events\Token\TokenCreating;

use Thunderlabid\Inspector\Listeners\Saving;
use Thunderlabid\Inspector\Listeners\Deleting;

class InspectorServiceProvider extends ServiceProvider
{
	public function boot()
	{
		////////////////
		// Validation //
		////////////////
		Event::listen(ClampCreating::class, Saving::class);
		Event::listen(ClampUpdating::class, Saving::class);
		Event::listen(ClampDeleting::class, Deleting::class);

		Event::listen(EnjoyerCreating::class, Saving::class);
		Event::listen(EnjoyerUpdating::class, Saving::class);
		Event::listen(EnjoyerDeleting::class, Deleting::class);

		Event::listen(GroupCreating::class, Saving::class);
		Event::listen(GroupUpdating::class, Saving::class);
		Event::listen(GroupDeleting::class, Deleting::class);

		Event::listen(MachineCreating::class, Saving::class);
		Event::listen(MachineUpdating::class, Saving::class);
		Event::listen(MachineDeleting::class, Deleting::class);

		Event::listen(ScopeCreating::class, Saving::class);
		Event::listen(ScopeUpdating::class, Saving::class);
		Event::listen(ScopeDeleting::class, Deleting::class);

		Event::listen(TokenCreating::class, Saving::class);
		Event::listen(TokenUpdating::class, Saving::class);
		Event::listen(TokenDeleting::class, Deleting::class);
	}

	public function register()
	{
	}
}