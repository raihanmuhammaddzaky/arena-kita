@props(['trxId', 'timeAgo', 'amount', 'user', 'description', 'image'])

<div class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col sm:flex-row gap-6 transition-all duration-200 hover:shadow-lg relative overflow-hidden group">
    <!-- Subtle accent bar -->
    <div class="absolute left-0 top-0 bottom-0 w-1 bg-secondary-container rounded-l-xl"></div>
    
    <!-- Thumbnail -->
    <div class="w-full sm:w-40 h-48 sm:h-auto bg-surface-container rounded-lg overflow-hidden shrink-0 relative cursor-pointer group-hover:ring-2 ring-secondary-container transition-all">
        <img class="w-full h-full object-cover" src="{{ $image }}" alt="Transaction Proof">
        <div class="absolute inset-0 bg-primary/10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
            <span class="material-symbols-outlined text-on-primary" style="font-variation-settings: 'FILL' 1;">zoom_in</span>
        </div>
    </div>
    
    <!-- Details & Actions -->
    <div class="flex-1 flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-start mb-2">
                <span class="bg-surface-container-high text-on-surface font-label-md text-label-md px-2 py-1 rounded">{{ $trxId }}</span>
                <span class="font-body-md text-body-md text-on-surface-variant">{{ $timeAgo }}</span>
            </div>
            <h3 class="font-headline-md text-headline-md text-primary mb-1">{{ $amount }}</h3>
            <p class="font-body-md text-body-md text-on-surface-variant mb-4">
                <strong class="text-on-surface">{{ $user }}</strong> • {{ $description }}
            </p>
        </div>
        
        <div class="flex items-center gap-3 mt-4">
            <button class="flex-1 bg-secondary text-on-secondary font-label-md text-label-md py-3 px-4 rounded-xl shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                Verify Payment
            </button>
            <button class="flex-none border border-outline text-error font-label-md text-label-md py-3 px-4 rounded-xl hover:bg-error-container hover:border-error-container hover:text-on-error-container transition-all flex items-center justify-center gap-2" title="Reject / Invalid">
                <span class="material-symbols-outlined">cancel</span>
            </button>
        </div>
    </div>
</div>
