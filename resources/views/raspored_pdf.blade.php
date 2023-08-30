<!DOCTYPE html>
<html>
<head>
    <title>{{ $raspored->naziv_rasporeda }}</title>
    <style>
        /* za naslov */
        h1 {
            color: #1862a2;
            font-size: 28px;
        }

        /* za periode vazenja */
        .period {
            color: #777;
            font-size: 18px;
        }

        /* za dane rasporeda */
        h3 {
            color: #555;
            font-size: 20px;
        }

        /* za stavke rasporeda */
        ul {
            list-style: none;
            padding-left: 0;
        }

        li {
            margin-bottom: 12px;
        }

        /* za nazive predmeta */
        .subject {
            color: #4c8bf5;
            margin-left: 12px;
        }

        /* za vremenski interval */
        .highlight {
            background-color: #f0f0f0;
            padding: 6px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>{{ $raspored->naziv_rasporeda }}</h1>
    <p class="period">Period vazenja rasporeda: {{ Carbon\Carbon::parse($raspored->datum_od)->format('d.m.Y.') }} - {{ Carbon\Carbon::parse($raspored->datum_do)->format('d.m.Y.') }}</p>

    @php
    $dan_trenutno = null;
    @endphp
    <ul>
        @foreach($raspored->stavkeRasporeda as $stavka)
            @if ($dan_trenutno != $stavka->dan->naziv_dana)
                @if ($dan_trenutno)
                    </ul>
                @endif
                <h3>{{ $stavka->dan->naziv_dana }}</h3>
                <ul>
                @php
                $dan_trenutno = $stavka->dan->naziv_dana;
                @endphp
            @endif
            <li>
                <span class="subject">{{ $stavka->predmet->naziv_predmeta }}</span>
                <span class="highlight">{{ $stavka->vremenskiInterval->interval }}</span>
            </li>
        @endforeach
        @if ($dan_trenutno)
            </ul>
        @endif
    </ul>
</body>
</html>
