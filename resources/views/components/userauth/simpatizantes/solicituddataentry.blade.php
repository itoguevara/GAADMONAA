<div class="grid auto-rows-min gap-4 md:grid-cols-1  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700 size-full" >
    <flux:card class="space-y-2">
        <form method="get" action="{{ route('simpatizante.store',['opcionvar' => $opcionvar]) }}" class="flex flex-col gap-6">
        @csrf
          <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 size-full">
          </div>    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </form>
    </flux:card>        
</div>    
