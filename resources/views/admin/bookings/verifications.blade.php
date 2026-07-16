@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Payment Verifications')

@section('content')
    <div class="max-w-container-max mx-auto flex flex-col gap-stack-lg relative z-10">
        
        <!-- Page Header -->
        <header class="flex justify-between items-end border-b border-surface-variant pb-6">
            <x-admin.page-header 
                title="Payment Verifications" 
                subtitle="Review and validate user transfer proofs to finalize bookings." 
            />
            <div class="flex items-center gap-4">
                <div class="bg-surface-container px-4 py-2 rounded-xl flex items-center gap-2">
                    <span class="material-symbols-outlined text-on-surface-variant">filter_list</span>
                    <span class="font-label-md text-label-md text-on-surface-variant">Pending Only</span>
                </div>
            </div>
        </header>

        <!-- Verification Queue Grid -->
        <section class="grid grid-cols-1 xl:grid-cols-2 gap-stack-md">
            
            <x-admin.verification-card 
                trxId="TRX-98234-A" 
                timeAgo="2 hours ago" 
                amount="Rp 450.000" 
                user="Budi Santoso" 
                description="Futsal Court A booking." 
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuAvW06OvsEx-eubR7puZS3eIYPnrdYlYnAB08Yjs50L56Wu9vLF9Y8bM35wMjJzUJeqVvbcmaPBNOI14gJ8KaqyxbzOoH8ZKPqn-x1apF0NwvQhZCg-G9rpOFvf9-THuWyEK-Ixl2oGXt1plV0fk1Vch8yHZoT8uA7a167D9qDky0i8yIqbP2IxaX83H_HqrLwtDYZfn2bKbXgL--M-7Ljtynmd24PdK6-jPqOqJuRT__05cEslKIabLA"
            />
            
            <x-admin.verification-card 
                trxId="TRX-98235-B" 
                timeAgo="3 hours ago" 
                amount="Rp 1.200.000" 
                user="Jakarta Tennis Club" 
                description="Weekend Tournament Booking." 
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuCYT9Cmcc0cCJQZUj6TYQlsouOk89utkwQBAIELfLuBzHqQKKO0PYV6O6k2qHqCPUBFy6Amq2uZ8oKQoosHaT8EWIcCtLMii4OJ1_7AKRoTjaliu_XDx8b8Tf9tDBhqH-vy4AxGB5uulHc7TyKxqPCmLJ3LxCUehhjReQ-NH12KzQTTS8X4lNrIy7qK4nAht8DyMvu7l9ifAkMYF_O2JCke0b3_pxkiff5ihzomgoG4jZfFs1GlGa0P-Q"
            />

        </section>
    </div>
@endsection
