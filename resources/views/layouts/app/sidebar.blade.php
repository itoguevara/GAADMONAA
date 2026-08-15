<flux:sidebar sticky collapsible="mobile"  class="sidebar-principal" :heading="__('Menu')">
    <flux:sidebar.nav>
        @php $RutaName = Route::currentRouteName();
        //dd($RutaName);
            @endphp
        @if($RutaName == 'home' or $RutaName == 'simpatizantes' or $RutaName == 'simpatizante.edit' or $RutaName == 'generic.show' or $RutaName == 'simpatizante' or $RutaName == 'simpatizante.search' or $RutaName == 'simpatizante.edit' or $RutaName == 'simpatizante.store' )
            @auth
            <flux:heading level="3" class="text-center text-xl text-gray-800 dark:text-gray-400">Opciones del Usuario</flux:heading>                        
            <flux:sidebar.group >
                <flux:card class="card-login" > <!--  Etiquetas del Menu de Usuarios-->
                <x-desktop-user-menu :opcionvar="$opcionvar ?? '0'" :id_user="auth()->user()->id ?? '0'" />  
                <div class="div-button-session div-button-session-logout">
                    <form method="POST" action="{{ route('logout') }}" class="boton-session-item">
                        @csrf
                        <flux:menu.radio.group>
                            <flux:menu.item
                                as="button"
                                type="submit"
                                name="logout"
                                value="logout"
                                icon=""
                                class="button-login button-accion-login button-large"
                                data-test="logout-button"
                            >
                            </flux:menu.item>

                        </flux:menu.radio.group>
                </form>
                </div>    
                <div class="absolute left-0 top-143 w-full" >
                    <img src="../../../imgweb/EdoBolivar.png" alt="Guayana Productiva en Positivo" width="500" height="300">
                </div>     
                </flux:card>
            </flux:sidebar.group>
            @else    
                <flux:heading level="3" class="text-center text-xl text-gray-800 dark:text-gray-400">Acceso a Datos</flux:heading>
                <flux:sidebar.group >
                    <flux:card class="card-login"> <!--  Etiquetas del Login-->
                        <x-auth.login  :opcionvar="$opcionvar ?? '0'">  </x-auth.login>
                    </flux:card>
                </flux:sidebar.group>
            @endauth
            <flux:separator />
        @else
        @endif 
        
    </flux:sidebar.nav>

    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
