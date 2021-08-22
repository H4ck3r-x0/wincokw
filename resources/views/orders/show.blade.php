<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Order Timeline") }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-00">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="
                                    py-2
                                    align-middle
                                    inline-block
                                    min-w-full
                                    sm:px-6
                                    lg:px-8
                                "
                            >
                                <div
                                    class="
                                        shadow
                                        overflow-hidden
                                        border-b border-gray-200
                                        sm:rounded-lg
                                    "
                                >
                                    @include('orders._showOrderTable')
                                </div>
                                <h1
                                    class="
                                        text-xl text-gray-400
                                        tracking-wide
                                        mt-3
                                    "
                                >
                                    Technical Study
                                </h1>
                                <div
                                    class="
                                        mt-2
                                        shadow
                                        overflow-hidden
                                        border-b border-gray-200
                                        sm:rounded-lg
                                    "
                                >
                                    @include('orders._showOrderSentsTable')
                                </div>
                                <h1
                                    class="
                                        text-xl text-gray-400
                                        tracking-wide
                                        mt-3
                                    "
                                >
                                    Purchases
                                </h1>

                                <div
                                    class="
                                        mt-2
                                        shadow
                                        overflow-hidden
                                        border-b border-gray-200
                                        sm:rounded-lg
                                    "
                                >
                                    @include('orders._showOrderPurchaseTable')
                                </div>
                                <h1
                                    class="
                                        text-xl text-gray-400
                                        tracking-wide
                                        mt-3
                                    "
                                >
                                    Production
                                </h1>
                                <div
                                    class="
                                        mt-2
                                        shadow
                                        overflow-hidden
                                        border-b border-gray-200
                                        sm:rounded-lg
                                    "
                                >
                                    @include('orders._showOrderProductionTable')
                                </div>
                                <h1
                                    class="
                                        text-xl text-gray-400
                                        tracking-wide
                                        mt-3
                                    "
                                >
                                    Distortion
                                </h1>
                                <div
                                    class="
                                        mt-2
                                        shadow
                                        overflow-hidden
                                        border-b border-gray-200
                                        sm:rounded-lg
                                    "
                                >
                                    @include('orders._showOrderDistortionsTable')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
