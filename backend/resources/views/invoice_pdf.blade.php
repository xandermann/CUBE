<h1>Facture Good Food no {{ $order->id }}, le {{ $order->date->format('d/m/Y') }} à {{ $order->date->format('H:i:s') }}</h1>

<p style="text-align: right">Par {{ $order->user->firstname }} {{ $order->user->lastname }} | {{ $order->user->email }}</p>

<br />
<br />
<br />
<br />
<br />


@if($order->menus->count() !== 0)
<h3>Menus:</h3>

    <table>
        <thead>
            <tr>
                <td>Nom</td>
                <td>Prix</td>
                <td>Quantité</td>
            </tr>
        </thead>

        <tr>
            @foreach($order->menus as $menu)
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->price }}€</td>
                <td>{{ $menu->pivot->quantity }}</td>
            @endforeach
        </tr>
    </table>
@endif

<h3>Plats:</h3>


@if($order->dishes->count() !== 0)
    <table>
        <thead>
            <tr>
                <td>Nom</td>
                <td>Prix</td>
                <td>Quantité</td>
            </tr>
        </thead>

        <tr>
            @foreach($order->dishes as $dish)
                <td>{{ $dish->name }}</td>
                <td>{{ $dish->price }}€</td>
                <td>{{ $dish->pivot->quantity }}</td>
            @endforeach
        </tr>
    </table>
@endif

<h2 style="text-align: right">Total: {{ $order->total_price }}€</h2>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table tr td {
    border: 1px solid black;
    width: 33.333333%;
}
</style>