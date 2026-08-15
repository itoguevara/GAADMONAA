@php
    $opcionvar = $attributes->get('opcionvar') ?? 0;
    
@endphp
<!-- Header Menu Config   -->
<flux:navbar  >
        <flux:navbar.item  class="navbar-item" icon="home" href="{{ route('generic.show', ['0']) }}" >Home</flux:navbar.item>
        <flux:navbar.item  class="navbar-item" href="{{ route('generic.show', ['3']) }}" icon="user-group">Quienes Somos ?</flux:navbar.item>
        <flux:navbar.item class="navbar-item" icon="chart-bar" href="{{ route('generic.show',['4']) }}"> Objetivos Estratégicos</flux:navbar.item>
        <flux:navbar.item class="navbar-item" icon="newspaper" href="{{ route('generic.show',['7']) }}"> Articulos de Opinion</flux:navbar.item>
        <flux:separator vertical/>
        <flux:navbar.item class="navbar-item" icon="magnifying-glass" href="#" label="Search" />
        <flux:navbar.item class="navbar-item" icon="cog-6-tooth" href="#" label="Settings" />
        <flux:navbar.item class="navbar-item" icon="information-circle" href="#" label="Help" />
</flux:navbar>
<div class="card-header-menu-config  dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700 size full" >
</div>     


