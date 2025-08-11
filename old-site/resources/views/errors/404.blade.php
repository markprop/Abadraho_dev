@extends('layouts.master')
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')
@section('content')

<style id="" media="all">/* cyrillic-ext */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 500;
  src: url(/fonts.gstatic.com/s/montserrat/v18/JTURjIg1_i6t8kCHKm45_ZpC3gTD_u50.woff2) format('woff2');
  unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 500;
  src: url(/fonts.gstatic.com/s/montserrat/v18/JTURjIg1_i6t8kCHKm45_ZpC3g3D_u50.woff2) format('woff2');
  unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 500;
  src: url(/fonts.gstatic.com/s/montserrat/v18/JTURjIg1_i6t8kCHKm45_ZpC3gbD_u50.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 500;
  src: url(/fonts.gstatic.com/s/montserrat/v18/JTURjIg1_i6t8kCHKm45_ZpC3gfD_u50.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 500;
  src: url(/fonts.gstatic.com/s/montserrat/v18/JTURjIg1_i6t8kCHKm45_ZpC3gnD_g.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
</style>
<style id="" media="all">/* latin-ext */
@font-face {
  font-family: 'Titillium Web';
  font-style: normal;
  font-weight: 700;
  src: url(/fonts.gstatic.com/s/titilliumweb/v10/NaPDcZTIAOhVxoMyOr9n_E7ffHjDGIVzY4SY.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Titillium Web';
  font-style: normal;
  font-weight: 700;
  src: url(/fonts.gstatic.com/s/titilliumweb/v10/NaPDcZTIAOhVxoMyOr9n_E7ffHjDGItzYw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
  font-family: 'Titillium Web';
  font-style: normal;
  font-weight: 900;
  src: url(/fonts.gstatic.com/s/titilliumweb/v10/NaPDcZTIAOhVxoMyOr9n_E7ffEDBGIVzY4SY.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Titillium Web';
  font-style: normal;
  font-weight: 900;
  src: url(/fonts.gstatic.com/s/titilliumweb/v10/NaPDcZTIAOhVxoMyOr9n_E7ffEDBGItzYw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

.asif{
  font-family: 'Titillium Web', sans-serif;
    font-size: 186px;
    font-weight: 900;
    margin: 0px;
    text-transform: uppercase;
    background: url(https://colorlib.com/etc/404/colorlib-error-404-1/img/text.png);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-size: cover;
    background-position: center;
}

.notfound a
{
    background-color: #E01E26 !important;

}

.notfound{

  top:35% !important;


}

#notfound
{
  margin-bottom: -10% !important;
}

</style>

<link type="text/css" rel="stylesheet" href="https://colorlib.com/etc/404/colorlib-error-404-1/css/style.css" />

<div id="notfound">
<div class="notfound">
<div>
<h1 class="asif">404</h1>
</div>
<h2>Oops! This Page Could Not Be Found</h2>
<p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
<a  href="{{url('/')}}">Go To Homepage</a>
</div>
</div>

</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6a206e5ca5cb7a98","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6a206e5bac2b7a98","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'></script>

@endsection
