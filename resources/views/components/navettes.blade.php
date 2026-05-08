<section class="py-14">
    <div class="lg:max-w-(--breakpoint-lg) container mx-auto px-4">
        @if ($withTitle)
        <h2 class="section-title mb-4 text-center">Navettes</h2>
        @endif
        <p class="mb-10 text-center text-lg text-gray-600">Des navettes seront organisées entre la place de fête et les hôtels.</p>
        <div class="grid items-start gap-8 lg:grid-cols-2">
            <div class="overflow-hidden rounded-[16px] shadow-[0_1px_4px_rgba(0,0,0,0.2)]">
                <div class="bg-theme-red px-6 py-3">
                    <h3 class="font-display text-xl font-semibold uppercase text-white">Vendredi 8 mai - soir<br>Place de fête → Hôtels</h3>
                </div>
                <ul class="divide-y divide-gray-200 bg-white px-6 py-2 text-lg font-medium text-gray-600">
                    <li class="py-3">23h00</li>
                    <li class="py-3">23h30</li>
                    <li class="py-3">00h00</li>
                    <li class="py-3">00h30</li>
                    <li class="py-3">01h00</li>
                </ul>
            </div>

            <div class="overflow-hidden rounded-[16px] shadow-[0_1px_4px_rgba(0,0,0,0.2)]">
                <div class="bg-theme-red px-6 py-3">
                    <h3 class="font-display text-xl font-semibold uppercase text-white">Samedi 9 mai - matin<br>Hôtels → Place de fête</h3>
                </div>
                <ul class="divide-y divide-gray-200 bg-white px-6 py-2 text-lg font-medium text-gray-600">
                    <li class="py-3">06h00</li>
                    <li class="py-3">06h30</li>
                    <li class="py-3">07h00</li>
                    <li class="py-3">07h30</li>
                    <li class="py-3">08h00</li>
                </ul>
            </div>
        </div>
    </div>
</section>
