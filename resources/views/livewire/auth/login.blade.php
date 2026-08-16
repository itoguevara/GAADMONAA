<x-layouts::auth>
  <div class="absolute left-0 top-0 w-full" >
    <img src="../../../imgweb/LogoAAPeq.png" alt="AGREDA & ASOCIADOS" width="500" height="300">
  </div>            

<div >
        <form method="POST" action="{{ route('login.store') }}" >
            @csrf
            <div class="absolute left-5 top-60 w-full md:w-3/4">
                <flux:heading class="text-titulo text-white size-text-subtitulo text-align-center" >Iniciar Sesión</flux:heading>
                <flux:text class="mt-2  text-white">Ingrese sus credenciales para acceder a su cuenta</flux:text>
            </div>
            <!-- Password -->
            <div class="absolute left-5 top-80 w-full md:w-3/4">
                <!-- Email Address -->
                <flux:field>
                    <flux:label class="text-footer-color">Email address</flux:label>
                    <flux:input
                        name="email"
                        :value="old('email')"
                        type="email"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="email@example.com"
                    />
                </flux:field>


            </div>
            <!-- Password -->
            <div class="absolute left-5 top-100 w-full md:w-3/4 size-min text-white">
                <!-- Email Address -->
                <flux:field>
                    <flux:label class="text-footer-color">Password</flux:label>                
                    <flux:input
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        :placeholder="__('Password')"
                        viewable
                    />
                </flux:field>                
            </div>
            <div class="absolute left-25 top-100 w-full">
                <flux:field>
                    <flux:label class="text-footer-color">Recordarme</flux:label>                
                    <flux:checkbox class="text-white" name="remember"  :checked="old('remember')" />
                </flux:field>                
            </div>
            
                @if (Route::has('password.request'))
                <div class="absolute left-5 top-117 w-full">
                <flux:field>
                    <flux:label class="text-footer-color">Recuperar contraseña</flux:label>                
                    <flux:link  :href="route('password.request')" wire:navigate>
                    </flux:link>
                </flux:field>                
                </div>   
                @endif
                    <div class="div-button-session div-button-session-login">
                        <flux:menu.radio.group>
                            <flux:menu.item
                                as="button"
                                type="submit"
                                name="login"
                                value="login"
                                icon=""
                                class="button-login button-accion-login button-large"
                                data-test="login-button"
                            >
                            </flux:menu.item>

                        </flux:menu.radio.group>
                    </div>                
            <!--
            <div class="absolute left-22 top-130 w-full">
                <flux:button  type="submit" class="boton-session" data-test="login-button">
                    {{ __('') }}
                </flux:button>
            </div>
        -->            
        </form>


        @if (Route::has('register') && config('flux.auth.allow_registration'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>{{ __('No tienes Cuenta?') }}</span>
                <flux:link :href="route('register')" wire:navigate>{{ __('Registrarse') }}</flux:link>
            </div>
        @endif
    </div>
  <div class="absolute left-0 top-143 w-full" >
    <img src="../../../imgweb/Justicia.png" alt="AGREDA & ASOCIADOS" width="500" height="300">
  </div>        
</x-layouts::auth>
