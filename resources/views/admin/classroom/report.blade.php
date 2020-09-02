<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Pasqyra Tabelare e suksesit te nxenesve</title>

  <style>.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  height: 21cm;
  width: 29.7cm;
  margin: 0 auto;
  color: #001028;
  background: #FFFFFF;
  font-family: Arial, sans-serif;
  font-size: 12px;
  font-family: Arial;
  overflow: hidden;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

h1.title {
  border-top: 1px solid #5D6975;
  border-bottom: 1px solid #5D6975;
  color: #5D6975;
  font-size: 2.2em;
  line-height: 1.3em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

h2 {
  padding-bottom: 0;
  margin-bottom: 0;
  font-size: 1.3em;
}

.center {
  text-align: center;
}

.mgtop-1 {
  margin-top: -45px;
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
}

#company span {
  color: #5D6975;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#project div,
#company div {
  white-space: nowrap;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 0px;
  border: 1px solid #C1CED9;

}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center !important;
  border: 1px solid #C1CED9;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border: 1px solid #C1CED9;
  white-space: nowrap;
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 5px 0px;
  text-align: right;

}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;
  ;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}</style>
</head>

<body>
  <header class="clearfix">
    <h1 class="title">PASQYRA TABELARE E SUKSESIT TE NXENESVE PER VITIN SHKOLLOR 2019/20</h1>
    @foreach($classrooms as $classroom)
    <div id="company" class="clearfix">
      <div><span> Kujdestari i paraleles.</span> {{$classroom->admin->full_name}}</div>
    </div>
    <div id="project">
      <div><span>Klasa.</span> {{$classroom->class_name}}</div>
    </div>
  </header>
  <main class="mgtop-1">
    <h2 class="center">Gjysmevjetori i pare</h2>
    <h2>SUKSESI POZITIV</h2>
    <table>
      <thead>
        <tr>
          <th colspan="3">Nr.nx te regj.</th>
          <th colspan="3">Nx. qe vijojne</th>
          <th colspan="3">Nx. qe nuk vij.</th>
          <th colspan="3">Nr.nx. te shkel.</th>
          <th colspan="3">Nr.nx. sh.mire</th>
          <th colspan="3">Nr.nx. te mire</th>
          <th colspan="3">Nr.nx. mjaft</th>
          <th colspan="3">Nr.nx. pozitiv</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
        </tr>
        <tr>
          <td>{{$classroom->male_count}}</td>
          <td>{{$classroom->female_count}}</td>
          <td>{{($classroom->female_count+$classroom->male_count)}}</td>
          <td>{{$classroom->male_active}}</td>
          <td>{{$classroom->female_active}}</td>
          <td>{{($classroom->female_active+$classroom->male_active)}}</td>
          <td>{{$classroom->male_notactive}}</td>
          <td>{{$classroom->female_notactive}}</td>
          <td>{{($classroom->female_notactive+$classroom->male_notactive)}}</td>
          <td>{{$classroom->male_excellentfp}}</td>
          <td>{{$classroom->female_excellentfp}}</td>
          <td>{{($classroom->female_excellentfp+$classroom->male_excellentfp)}}</td>
          <td>{{$classroom->male_goodfp}}</td>
          <td>{{$classroom->female_goodfp}}</td>
          <td>{{($classroom->female_goodfp+$classroom->male_goodfp)}}</td>
          <td>{{$classroom->male_avgfp}}</td>
          <td>{{$classroom->female_avgfp}}</td>
          <td>{{($classroom->female_avgfp+$classroom->male_avgfp)}}</td>
          <td>{{$classroom->male_badfp}}</td>
          <td>{{$classroom->female_badfp}}</td>
          <td>{{($classroom->female_badfp+$classroom->male_badfp)}}</td>
          <td>{{($classroom->male_excellentfp + $classroom->male_goodfp + $classroom->male_avgfp + $classroom->male_badfp )}}</td>
          <td>{{($classroom->female_excellentfp + $classroom->female_goodfp + $classroom->female_avgfp + $classroom->female_badfp )}}</td>
          <td>{{($classroom->female_excellentfp + $classroom->female_goodfp + $classroom->female_avgfp + $classroom->female_badfp )+ ($classroom->male_excellentfp + $classroom->male_goodfp + $classroom->male_avgfp + $classroom->male_badfp )}}</td>
        </tr>
      </tbody>
    </table>
    <h2>SUKSESI NEGATIV</h2>
    <table>
      <thead>
        <tr>
          <th colspan="3">Nr.nx te regj.</th>
          <th colspan="3">Nx. qe vijojne</th>
          <th colspan="3">Nx. qe nuk vij.</th>
          <th colspan="3">Nr.nx. negative.</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>
          <td>M</td>
          <td>F</td>
          <td>GJ</td>

        </tr>
        <tr>
            <td>{{$classroom->male_count}}</td>
            <td>{{$classroom->female_count}}</td>
            <td>{{($classroom->female_count+$classroom->male_count)}}</td>
            <td>{{$classroom->male_active}}</td>
            <td>{{$classroom->female_active}}</td>
            <td>{{($classroom->female_active+$classroom->male_active)}}</td>
            <td>{{$classroom->male_notactive}}</td>
            <td>{{$classroom->female_notactive}}</td>
            <td>{{($classroom->female_notactive+$classroom->male_notactive)}}</td>
            <td>{{$classroom->male_worsefp}}</td>
            <td>{{$classroom->female_worsefp}}</td>
            <td>{{($classroom->female_worsefp+$classroom->male_worsefp)}}</td>
        </tr>
      </tbody>
    </table>
  </main>
  <main>
    <h2 class="center">Gjysmevjetori i dyte</h2>
    <h2>SUKSESI POZITIV</h2>
    <table>
        <thead>
          <tr>
            <th colspan="3">Nr.nx te regj.</th>
            <th colspan="3">Nx. qe vijojne</th>
            <th colspan="3">Nx. qe nuk vij.</th>
            <th colspan="3">Nr.nx. te shkel.</th>
            <th colspan="3">Nr.nx. sh.mire</th>
            <th colspan="3">Nr.nx. te mire</th>
            <th colspan="3">Nr.nx. mjaft</th>
            <th colspan="3">Nr.nx. pozitiv</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
          </tr>
          <tr>
            <td>{{$classroom->male_count}}</td>
            <td>{{$classroom->female_count}}</td>
            <td>{{($classroom->female_count+$classroom->male_count)}}</td>
            <td>{{$classroom->male_active}}</td>
            <td>{{$classroom->female_active}}</td>
            <td>{{($classroom->female_active+$classroom->male_active)}}</td>
            <td>{{$classroom->male_notactive}}</td>
            <td>{{$classroom->female_notactive}}</td>
            <td>{{($classroom->female_notactive+$classroom->male_notactive)}}</td>
            <td>{{$classroom->male_excellentsp}}</td>
            <td>{{$classroom->female_excellentsp}}</td>
            <td>{{($classroom->female_excellentsp+$classroom->male_excellentsp)}}</td>
            <td>{{$classroom->male_goodsp}}</td>
            <td>{{$classroom->female_goodsp}}</td>
            <td>{{($classroom->female_goodsp+$classroom->male_goodsp)}}</td>
            <td>{{$classroom->male_avgsp}}</td>
            <td>{{$classroom->female_avgsp}}</td>
            <td>{{($classroom->female_avgsp+$classroom->male_avgsp)}}</td>
            <td>{{$classroom->male_badsp}}</td>
            <td>{{$classroom->female_badsp}}</td>
            <td>{{($classroom->female_badsp+$classroom->male_badsp)}}</td>
            <td>{{($classroom->male_excellentsp + $classroom->male_goodsp + $classroom->male_avgsp + $classroom->male_badsp )}}</td>
            <td>{{($classroom->female_excellentsp + $classroom->female_goodsp + $classroom->female_avgsp + $classroom->female_badsp )}}</td>
            <td>{{($classroom->female_excellentsp + $classroom->female_goodsp + $classroom->female_avgsp + $classroom->female_badsp )+ ($classroom->male_excellentsp + $classroom->male_goodsp + $classroom->male_avgsp + $classroom->male_badsp )}}</td>
          </tr>
        </tbody>
      </table>
      <h2>SUKSESI NEGATIV</h2>
      <table>
        <thead>
          <tr>
            <th colspan="3">Nr.nx te regj.</th>
            <th colspan="3">Nx. qe vijojne</th>
            <th colspan="3">Nx. qe nuk vij.</th>
            <th colspan="3">Nr.nx. negative.</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>
            <td>M</td>
            <td>F</td>
            <td>GJ</td>

          </tr>
          <tr>
              <td>{{$classroom->male_count}}</td>
              <td>{{$classroom->female_count}}</td>
              <td>{{($classroom->female_count+$classroom->male_count)}}</td>
              <td>{{$classroom->male_active}}</td>
              <td>{{$classroom->female_active}}</td>
              <td>{{($classroom->female_active+$classroom->male_active)}}</td>
              <td>{{$classroom->male_notactive}}</td>
              <td>{{$classroom->female_notactive}}</td>
              <td>{{($classroom->female_notactive+$classroom->male_notactive)}}</td>
              <td>{{$classroom->male_worsesp}}</td>
              <td>{{$classroom->female_worsesp}}</td>
              <td>{{($classroom->female_worsesp+$classroom->male_worsesp)}}</td>
          </tr>
        </tbody>
      </table>

  </main>
  <p>Emri dhe mbiemri i nx. qe nuk vijojne dhe arsyja.</p>
  @if($classroom->not_active->count() != 0)
  @foreach($classroom->not_active as $user)
      <p>{{$loop->iteration}}. {{$user->full_name}} - {{$user->status}}</p>
  @endforeach
  @else
   Nuk ka nxenes qe nuk vijojne
   @endif
  @endforeach
</body>

</html>
