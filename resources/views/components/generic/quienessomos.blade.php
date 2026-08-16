<flux:text class="text-titulo size-text-titulo text-align-center">
    “GUAYANA  ES  EL GRAN POLO DE DESARROLLO DE VENEZUELA” 
</flux:text>

<div class="grid auto-rows-min gap-4 md:grid-cols-1  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700" size-full>
    <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 size-full">
        <flux:heading level="3" class="text-titulo size-text-head-parrafos text-align-center">¿Quiénes Somos en Guayana en Positivo?</flux:heading>
        <flux:spacer />
        <flux:separator />
        <flux:spacer />
        <flux:text class="mt-2 text-lg">
            Somos una plataforma multisectorial y plural integrada por profesionales multidisciplinarios, 
            empresarios, comerciantes, emprendedores, líderes sociales y actores políticos de diversas tendencias,
            unidos por un compromiso inquebrantable con el estado Bolívar. Nos define una sólida y comprobada 
            experiencia en áreas clave de productividad, gestión y gobernabilidad.
        </flux:text>
        <flux:spacer />
        <flux:text class="mt-2  text-lg">
            Lejos de ser las diferencias un obstáculo, en "Guayana en Positivo" convertimos la diversidad de 
            visiones en nuestra mayor fortaleza; un espacio de encuentro donde el conocimiento técnico, 
            el dinamismo económico, la sensibilidad social y la voluntad política convergen armónicamente.
        </flux:text>
        <flux:spacer />
        <flux:text class="mt-2  text-lg">
            Somos, en esencia, una fuerza viva y corresponsable que acciona con un mismo norte: articular soluciones viables,
            sostenibles y con visión de futuro para impulsar el desarrollo económico y social integral de nuestra región y el
            progreso de todo el país.
        </flux:text>
        <flux:spacer />
        <flux:separator />
        <div><flux:spacer /><flux:spacer /><flux:spacer /></div>
        <flux:spacer />
        <flux:heading level="3" class="text-titulo size-text-head-parrafos text-align-left">Lineas macro de trabajo:</flux:heading>
        <flux:spacer/>
        <flux:separator />
        <flux:spacer />
        <flux:checkbox.group wire:model="notifications" label="Motores de Desarrollo : ">
            <flux:spacer></flux:spacer>
            <flux:checkbox label="📌AGREDA & ASOCIADOS+. (Motor Económico)." value="dni" checked />
            <flux:checkbox label="📌Guayana Social en Positivo+. (Motor Humano e Institucional)." value="nie" checked />
        </flux:checkbox.group>              
        <flux:spacer />
    </div>
</div>
<div class="grid auto-rows-min gap-4 md:grid-cols-2  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700">    
    <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 size-full">
        <flux:heading level="3" class="text-titulo size-text-head-parrafos text-align-center">👁️ Visión.</flux:heading>
        <flux:spacer />
        <flux:separator />
        <flux:spacer />
        <flux:text class="mt-2 text-lg">
                Ser la plataforma líder de articulación y transformación en el estado Bolívar, 
                reconocida por consolidar a la región como un modelo de desarrollo moderno, 
                próspero y sustentable, donde la sinergia entre el motor productivo y el 
                bienestar social impulse el progreso de todo el país. 
        </flux:text>
    </div>    
    <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 size-full">
        <flux:heading level="3" class="text-titulo size-text-head-parrafos text-align-center">🎯 Misión.</flux:heading>
        <flux:spacer />
        <flux:separator />
        <flux:spacer />
        <flux:text class="mt-2 text-lg">
                Conectar, inspirar y movilizar a ciudadanos, empresarios y líderes sociales del estado Bolívar,
                integrando el desarrollo económico con el progreso humano institucional. 
        </flux:text>        
        <flux:spacer/>
        <flux:text class="mt-2  text-lg">
                Promovemos el sentido de pertenencia y la acción corresponsable para generar soluciones concretas 
                que construyan la Guayana moderna y el país del futuro.       
        </flux:text>
    </div>
</div>       
<div class="grid auto-rows-min gap-4 md:grid-cols-2  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700">    
    <div class="div-img-invita-gepo"></div>
    <div>
        <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 size-full">
            <flux:heading level="3" class="text-titulo size-text-head-parrafos text-align-center">🎯 Invitacion.</flux:heading>
            <flux:spacer />
            <flux:text class="mt-2 text-lg">
                    Si compartes nuestra visión y deseas contribuir al desarrollo de la región, te invitamos a ser parte de esta iniciativa.
                    Juntos podemos marcar la diferencia y construir un futuro más prometedor para nuestra comunidad. Tu participación es 
                    fundamental para impulsar el cambio positivo que Guayana necesita. Sumando tu voz, tu experiencia y tu compromiso para 
                    construir juntos un futuro más prometedor para nuestra región y nuestro país.
            </flux:text>
            <flux:spacer />
            <flux:separator />
            <form method="get" >
            @csrf
                <flux:menu.radio.group>
                    <flux:menu.item
                        as="button"
                        href="{{ route('simpatizante.edit', ['id_persona' =>Crypt::encrypt(-1),'id_solicitud' =>Crypt::encrypt(-1),'id_simpatizante' =>Crypt::encrypt(-1),'id_accion' => '1','id_llamada' => '1']) }}"
                        type="submit"
                        name="infobtn"
                        value="0"
                        class="button-accion-invita-gepo button-large"
                        data-test="info-button"
                    >
                    </flux:menu.item>
                </flux:menu.radio.group>
            </form>
        </div>    
    </div>
</div>            
<div class="grid auto-rows-min gap-4 md:grid-cols-1  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700">    
    <flux:spacer></flux:spacer>
    <flux:card class="card-info-secun">
        <div class="space-y-4">
            <flux:spacer></flux:spacer>
            <flux:heading level="3" class="text-titulo size-text-head-parrafos text-align-center">🎙️ “AGREDA & ASOCIADOS”, transmitido por CVG La Voz de Guayana 89.7 FM </flux:heading>
            <flux:text class="mt-2 text-lg">
                    Bajo la conducción del Lcdo. Yorman Hernández Sánchez, este espacio promueve el emprendimiento,
                    la innovación y la articulación productiva en nuestra región.
                    “La transformación del país comenzará a través de su gente… Cambias tú, cambiará Venezuela.”
            </flux:text>
            <flux:spacer />
        </div>
        <div class="space-y-4">    
            <flux:heading level="3" class="text-titulo size-titulo-opciones text-align-left">Se abordan temas claves como : </flux:heading>
            <flux:spacer/>
            <flux:separator />
            <flux:spacer />
            <flux:checkbox.group level="3" class="text-left  text-xl text-gray-800 dark:text-gray-400">
                    
                <flux:spacer></flux:spacer>
                <flux:checkbox label="📌Exportaciones, fortalecimiento del sector minero y estrategias para diversificar la economía." value="dni" checked />
                <flux:checkbox label="📌Con voces expertas y líderes regionales, seguimos construyendo una Guayana más productiva y llena de oportunidades." value="nie" checked />
            </flux:checkbox.group>
            <flux:separator></flux:separator>
            <flux:spacer></flux:spacer>
        </div>
    </flux:card>
    <flux:spacer></flux:spacer>
</div>




