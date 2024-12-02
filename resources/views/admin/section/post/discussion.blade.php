@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Discussons About Project</h4>

        {{-- project list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-5 g-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Project Name</h5>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary btn-sm">View Projects</a>
                    </div>

                    <div class="row p-4 g-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body row widget-separator g-0">
                                    <div class="col-sm-5 border-shift border-end  pe-sm-6">
                                        <h3 class="text-primary d-flex align-items-center gap-2 mb-2">4.89<i
                                                class="bx bxs-star bx-30px"></i></h3>
                                        <p class="h6 mb-2">Total 187 reviews</p>
                                        <p class="pe-2 mb-2">All reviews are from genuine customers</p>
                                        <span class="badge bg-label-primary mb-4 mb-sm-0">+5 This week</span>
                                        <hr class="d-sm-none">
                                    </div>

                                    <div
                                        class="col-sm-7 gap-2 text-nowrap d-flex flex-column justify-content-between ps-sm-5 pt-2 py-sm-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <small>5 Star</small>
                                            <div class="progress w-100 bg-label-primary" style="height:8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 85%"
                                                    aria-valuenow="61.50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="w-px-20 text-end">124</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <small>4 Star</small>
                                            <div class="progress w-100 bg-label-primary" style="height:8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%"
                                                    aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="w-px-20 text-end">40</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <small>3 Star</small>
                                            <div class="progress w-100 bg-label-primary" style="height:8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 35%"
                                                    aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="w-px-20 text-end">12</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <small>2 Star</small>
                                            <div class="progress w-100 bg-label-primary" style="height:8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 18%"
                                                    aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="w-px-20 text-end">7</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <small>1 Star</small>
                                            <div class="progress w-100 bg-label-primary" style="height:8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 10%"
                                                    aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="w-px-20 text-end">2</small>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body row">
                                    <div class="col-sm-5">
                                        <div class="mb-5">
                                            <h5 class="mb-2 text-nowrap">Reviews statistics</h5>
                                            <p class="mb-0"> <span class="me-2">12 New reviews</span> <span
                                                    class="badge bg-label-success">+8.4%</span></p>
                                        </div>

                                        <div>
                                            <h6 class="mb-2 fw-normal">
                                                <span class="text-success me-1">87%</span>Positive reviews
                                            </h6>
                                            <small>Weekly Report</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-7 d-flex justify-content-sm-end align-items-end"
                                        style="position: relative;">
                                        <div id="reviewsChart" style="min-height: 145px;">
                                            <div id="apexchartswdaeu6lw"
                                                class="apexcharts-canvas apexchartswdaeu6lw apexcharts-theme-light"
                                                style="width: 190px; height: 130px;"><svg id="SvgjsSvg1738" width="190"
                                                    height="130" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                    xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                    style="background: transparent;">
                                                    <g id="SvgjsG1740" class="apexcharts-inner apexcharts-graphical"
                                                        transform="translate(22, 5)">
                                                        <defs id="SvgjsDefs1739">
                                                            <linearGradient id="SvgjsLinearGradient1743" x1="0"
                                                                y1="0" x2="0" y2="1">
                                                                <stop id="SvgjsStop1744" stop-opacity="0.4"
                                                                    stop-color="rgba(216,227,240,0.4)" offset="0">
                                                                </stop>
                                                                <stop id="SvgjsStop1745" stop-opacity="0.5"
                                                                    stop-color="rgba(190,209,230,0.5)" offset="1">
                                                                </stop>
                                                                <stop id="SvgjsStop1746" stop-opacity="0.5"
                                                                    stop-color="rgba(190,209,230,0.5)" offset="1">
                                                                </stop>
                                                            </linearGradient>
                                                            <clipPath id="gridRectMaskwdaeu6lw">
                                                                <rect id="SvgjsRect1748" width="162"
                                                                    height="98.70079907417298" x="-2" y="0" rx="0"
                                                                    ry="0" opacity="1" stroke-width="0"
                                                                    stroke="none" stroke-dasharray="0" fill="#fff">
                                                                </rect>
                                                            </clipPath>
                                                            <clipPath id="forecastMaskwdaeu6lw"></clipPath>
                                                            <clipPath id="nonForecastMaskwdaeu6lw"></clipPath>
                                                            <clipPath id="gridRectMarkerMaskwdaeu6lw">
                                                                <rect id="SvgjsRect1749" width="162"
                                                                    height="102.70079907417298" x="-2" y="-2"
                                                                    rx="0" ry="0" opacity="1"
                                                                    stroke-width="0" stroke="none" stroke-dasharray="0"
                                                                    fill="#fff"></rect>
                                                            </clipPath>
                                                        </defs>
                                                        <rect id="SvgjsRect1747" width="9.028571428571428"
                                                            height="98.70079907417298" x="0" y="0" rx="0"
                                                            ry="0" opacity="1" stroke-width="0"
                                                            stroke-dasharray="3" fill="url(#SvgjsLinearGradient1743)"
                                                            class="apexcharts-xcrosshairs" y2="98.70079907417298"
                                                            filter="none" fill-opacity="0.9"></rect>
                                                        <g id="SvgjsG1768" class="apexcharts-xaxis"
                                                            transform="translate(0, 0)">
                                                            <g id="SvgjsG1769" class="apexcharts-xaxis-texts-g"
                                                                transform="translate(0, -4)"><text id="SvgjsText1771"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="11.285714285714286" y="127.70079907417298"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="13px" font-weight="400" fill="#a7acb2"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan1772">M</tspan>
                                                                    <title>M</title>
                                                                </text><text id="SvgjsText1774"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="33.85714285714286" y="127.70079907417298"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="13px" font-weight="400" fill="#a7acb2"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan1775">T</tspan>
                                                                    <title>T</title>
                                                                </text><text id="SvgjsText1777"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="56.42857142857144" y="127.70079907417298"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="13px" font-weight="400" fill="#a7acb2"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan1778">W</tspan>
                                                                    <title>W</title>
                                                                </text><text id="SvgjsText1780"
                                                                    font-family="Helvetica, Arial, sans-serif" x="79"
                                                                    y="127.70079907417298" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="13px"
                                                                    font-weight="400" fill="#a7acb2"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan1781">T</tspan>
                                                                    <title>T</title>
                                                                </text><text id="SvgjsText1783"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="101.57142857142857" y="127.70079907417298"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="13px" font-weight="400" fill="#a7acb2"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan1784">F</tspan>
                                                                    <title>F</title>
                                                                </text><text id="SvgjsText1786"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="124.14285714285715" y="127.70079907417298"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="13px" font-weight="400" fill="#a7acb2"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan1787">S</tspan>
                                                                    <title>S</title>
                                                                </text><text id="SvgjsText1789"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="146.71428571428575" y="127.70079907417298"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="13px" font-weight="400" fill="#a7acb2"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan1790">S</tspan>
                                                                    <title>S</title>
                                                                </text></g>
                                                        </g>
                                                        <g id="SvgjsG1793" class="apexcharts-grid">
                                                            <g id="SvgjsG1794" class="apexcharts-gridlines-horizontal"
                                                                style="display: none;">
                                                                <line id="SvgjsLine1796" x1="0" y1="0"
                                                                    x2="158" y2="0" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine1797" x1="0"
                                                                    y1="24.675199768543244" x2="158"
                                                                    y2="24.675199768543244" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine1798" x1="0"
                                                                    y1="49.35039953708649" x2="158"
                                                                    y2="49.35039953708649" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine1799" x1="0"
                                                                    y1="74.02559930562973" x2="158"
                                                                    y2="74.02559930562973" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine1800" x1="0"
                                                                    y1="98.70079907417298" x2="158"
                                                                    y2="98.70079907417298" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                            </g>
                                                            <g id="SvgjsG1795" class="apexcharts-gridlines-vertical"
                                                                style="display: none;"></g>
                                                            <line id="SvgjsLine1802" x1="0"
                                                                y1="98.70079907417298" x2="158"
                                                                y2="98.70079907417298" stroke="transparent"
                                                                stroke-dasharray="0" stroke-linecap="butt"></line>
                                                            <line id="SvgjsLine1801" x1="0" y1="1"
                                                                x2="0" y2="98.70079907417298"
                                                                stroke="transparent" stroke-dasharray="0"
                                                                stroke-linecap="butt"></line>
                                                        </g>
                                                        <g id="SvgjsG1750"
                                                            class="apexcharts-bar-series apexcharts-plot-series">
                                                            <g id="SvgjsG1751" class="apexcharts-series" rel="1"
                                                                seriesName="seriesx1" data:realIndex="0">
                                                                <path id="SvgjsPath1755"
                                                                    d="M 6.771428571428572 93.70079907417298L 6.771428571428572 87.25066589514415Q 6.771428571428572 82.25066589514415 11.771428571428572 82.25066589514415L 10.8 82.25066589514415Q 15.8 82.25066589514415 15.8 87.25066589514415L 15.8 87.25066589514415L 15.8 93.70079907417298Q 15.8 98.70079907417298 10.8 98.70079907417298L 11.771428571428572 98.70079907417298Q 6.771428571428572 98.70079907417298 6.771428571428572 93.70079907417298z"
                                                                    fill="#71dd3729" fill-opacity="1" stroke-opacity="1"
                                                                    stroke-linecap="round" stroke-width="0"
                                                                    stroke-dasharray="0" class="apexcharts-bar-area"
                                                                    index="0" clip-path="url(#gridRectMaskwdaeu6lw)"
                                                                    pathTo="M 6.771428571428572 93.70079907417298L 6.771428571428572 87.25066589514415Q 6.771428571428572 82.25066589514415 11.771428571428572 82.25066589514415L 10.8 82.25066589514415Q 15.8 82.25066589514415 15.8 87.25066589514415L 15.8 87.25066589514415L 15.8 93.70079907417298Q 15.8 98.70079907417298 10.8 98.70079907417298L 11.771428571428572 98.70079907417298Q 6.771428571428572 98.70079907417298 6.771428571428572 93.70079907417298z"
                                                                    pathFrom="M 6.771428571428572 93.70079907417298L 6.771428571428572 93.70079907417298L 15.8 93.70079907417298L 15.8 93.70079907417298L 15.8 93.70079907417298L 15.8 93.70079907417298L 15.8 93.70079907417298L 6.771428571428572 93.70079907417298"
                                                                    cy="82.25066589514415" cx="29.342857142857145" j="0"
                                                                    val="20" barHeight="16.45013317902883"
                                                                    barWidth="9.028571428571428"></path>
                                                                <path id="SvgjsPath1757"
                                                                    d="M 29.342857142857145 93.70079907417298L 29.342857142857145 70.80053271611533Q 29.342857142857145 65.80053271611533 34.34285714285714 65.80053271611533L 33.371428571428574 65.80053271611533Q 38.371428571428574 65.80053271611533 38.371428571428574 70.80053271611533L 38.371428571428574 70.80053271611533L 38.371428571428574 93.70079907417298Q 38.371428571428574 98.70079907417298 33.371428571428574 98.70079907417298L 34.34285714285714 98.70079907417298Q 29.342857142857145 98.70079907417298 29.342857142857145 93.70079907417298z"
                                                                    fill="#71dd3729" fill-opacity="1" stroke-opacity="1"
                                                                    stroke-linecap="round" stroke-width="0"
                                                                    stroke-dasharray="0" class="apexcharts-bar-area"
                                                                    index="0" clip-path="url(#gridRectMaskwdaeu6lw)"
                                                                    pathTo="M 29.342857142857145 93.70079907417298L 29.342857142857145 70.80053271611533Q 29.342857142857145 65.80053271611533 34.34285714285714 65.80053271611533L 33.371428571428574 65.80053271611533Q 38.371428571428574 65.80053271611533 38.371428571428574 70.80053271611533L 38.371428571428574 70.80053271611533L 38.371428571428574 93.70079907417298Q 38.371428571428574 98.70079907417298 33.371428571428574 98.70079907417298L 34.34285714285714 98.70079907417298Q 29.342857142857145 98.70079907417298 29.342857142857145 93.70079907417298z"
                                                                    pathFrom="M 29.342857142857145 93.70079907417298L 29.342857142857145 93.70079907417298L 38.371428571428574 93.70079907417298L 38.371428571428574 93.70079907417298L 38.371428571428574 93.70079907417298L 38.371428571428574 93.70079907417298L 38.371428571428574 93.70079907417298L 29.342857142857145 93.70079907417298"
                                                                    cy="65.80053271611533" cx="51.91428571428572" j="1"
                                                                    val="40" barHeight="32.90026635805766"
                                                                    barWidth="9.028571428571428"></path>
                                                                <path id="SvgjsPath1759"
                                                                    d="M 51.91428571428572 93.70079907417298L 51.91428571428572 54.350399537086496Q 51.91428571428572 49.350399537086496 56.91428571428572 49.350399537086496L 55.94285714285715 49.350399537086496Q 60.94285714285715 49.350399537086496 60.94285714285715 54.350399537086496L 60.94285714285715 54.350399537086496L 60.94285714285715 93.70079907417298Q 60.94285714285715 98.70079907417298 55.94285714285715 98.70079907417298L 56.91428571428572 98.70079907417298Q 51.91428571428572 98.70079907417298 51.91428571428572 93.70079907417298z"
                                                                    fill="#71dd3729" fill-opacity="1" stroke-opacity="1"
                                                                    stroke-linecap="round" stroke-width="0"
                                                                    stroke-dasharray="0" class="apexcharts-bar-area"
                                                                    index="0" clip-path="url(#gridRectMaskwdaeu6lw)"
                                                                    pathTo="M 51.91428571428572 93.70079907417298L 51.91428571428572 54.350399537086496Q 51.91428571428572 49.350399537086496 56.91428571428572 49.350399537086496L 55.94285714285715 49.350399537086496Q 60.94285714285715 49.350399537086496 60.94285714285715 54.350399537086496L 60.94285714285715 54.350399537086496L 60.94285714285715 93.70079907417298Q 60.94285714285715 98.70079907417298 55.94285714285715 98.70079907417298L 56.91428571428572 98.70079907417298Q 51.91428571428572 98.70079907417298 51.91428571428572 93.70079907417298z"
                                                                    pathFrom="M 51.91428571428572 93.70079907417298L 51.91428571428572 93.70079907417298L 60.94285714285715 93.70079907417298L 60.94285714285715 93.70079907417298L 60.94285714285715 93.70079907417298L 60.94285714285715 93.70079907417298L 60.94285714285715 93.70079907417298L 51.91428571428572 93.70079907417298"
                                                                    cy="49.350399537086496" cx="74.4857142857143" j="2"
                                                                    val="60" barHeight="49.35039953708648"
                                                                    barWidth="9.028571428571428"></path>
                                                                <path id="SvgjsPath1761"
                                                                    d="M 74.4857142857143 93.70079907417298L 74.4857142857143 37.900266358057664Q 74.4857142857143 32.900266358057664 79.4857142857143 32.900266358057664L 78.51428571428572 32.900266358057664Q 83.51428571428572 32.900266358057664 83.51428571428572 37.900266358057664L 83.51428571428572 37.900266358057664L 83.51428571428572 93.70079907417298Q 83.51428571428572 98.70079907417298 78.51428571428572 98.70079907417298L 79.4857142857143 98.70079907417298Q 74.4857142857143 98.70079907417298 74.4857142857143 93.70079907417298z"
                                                                    fill="#71dd3729" fill-opacity="1" stroke-opacity="1"
                                                                    stroke-linecap="round" stroke-width="0"
                                                                    stroke-dasharray="0" class="apexcharts-bar-area"
                                                                    index="0" clip-path="url(#gridRectMaskwdaeu6lw)"
                                                                    pathTo="M 74.4857142857143 93.70079907417298L 74.4857142857143 37.900266358057664Q 74.4857142857143 32.900266358057664 79.4857142857143 32.900266358057664L 78.51428571428572 32.900266358057664Q 83.51428571428572 32.900266358057664 83.51428571428572 37.900266358057664L 83.51428571428572 37.900266358057664L 83.51428571428572 93.70079907417298Q 83.51428571428572 98.70079907417298 78.51428571428572 98.70079907417298L 79.4857142857143 98.70079907417298Q 74.4857142857143 98.70079907417298 74.4857142857143 93.70079907417298z"
                                                                    pathFrom="M 74.4857142857143 93.70079907417298L 74.4857142857143 93.70079907417298L 83.51428571428572 93.70079907417298L 83.51428571428572 93.70079907417298L 83.51428571428572 93.70079907417298L 83.51428571428572 93.70079907417298L 83.51428571428572 93.70079907417298L 74.4857142857143 93.70079907417298"
                                                                    cy="32.900266358057664" cx="97.05714285714286" j="3"
                                                                    val="80" barHeight="65.80053271611531"
                                                                    barWidth="9.028571428571428"></path>
                                                                <path id="SvgjsPath1763"
                                                                    d="M 97.05714285714286 93.70079907417298L 97.05714285714286 21.45013317902884Q 97.05714285714286 16.45013317902884 102.05714285714286 16.45013317902884L 101.08571428571429 16.45013317902884Q 106.08571428571429 16.45013317902884 106.08571428571429 21.45013317902884L 106.08571428571429 21.45013317902884L 106.08571428571429 93.70079907417298Q 106.08571428571429 98.70079907417298 101.08571428571429 98.70079907417298L 102.05714285714286 98.70079907417298Q 97.05714285714286 98.70079907417298 97.05714285714286 93.70079907417298z"
                                                                    fill="rgba(113,221,55,0.85)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="round"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-bar-area" index="0"
                                                                    clip-path="url(#gridRectMaskwdaeu6lw)"
                                                                    pathTo="M 97.05714285714286 93.70079907417298L 97.05714285714286 21.45013317902884Q 97.05714285714286 16.45013317902884 102.05714285714286 16.45013317902884L 101.08571428571429 16.45013317902884Q 106.08571428571429 16.45013317902884 106.08571428571429 21.45013317902884L 106.08571428571429 21.45013317902884L 106.08571428571429 93.70079907417298Q 106.08571428571429 98.70079907417298 101.08571428571429 98.70079907417298L 102.05714285714286 98.70079907417298Q 97.05714285714286 98.70079907417298 97.05714285714286 93.70079907417298z"
                                                                    pathFrom="M 97.05714285714286 93.70079907417298L 97.05714285714286 93.70079907417298L 106.08571428571429 93.70079907417298L 106.08571428571429 93.70079907417298L 106.08571428571429 93.70079907417298L 106.08571428571429 93.70079907417298L 106.08571428571429 93.70079907417298L 97.05714285714286 93.70079907417298"
                                                                    cy="16.45013317902884" cx="119.62857142857143" j="4"
                                                                    val="100" barHeight="82.25066589514414"
                                                                    barWidth="9.028571428571428"></path>
                                                                <path id="SvgjsPath1765"
                                                                    d="M 119.62857142857143 93.70079907417298L 119.62857142857143 37.900266358057664Q 119.62857142857143 32.900266358057664 124.62857142857143 32.900266358057664L 123.65714285714287 32.900266358057664Q 128.65714285714287 32.900266358057664 128.65714285714287 37.900266358057664L 128.65714285714287 37.900266358057664L 128.65714285714287 93.70079907417298Q 128.65714285714287 98.70079907417298 123.65714285714287 98.70079907417298L 124.62857142857143 98.70079907417298Q 119.62857142857143 98.70079907417298 119.62857142857143 93.70079907417298z"
                                                                    fill="#71dd3729" fill-opacity="1" stroke-opacity="1"
                                                                    stroke-linecap="round" stroke-width="0"
                                                                    stroke-dasharray="0" class="apexcharts-bar-area"
                                                                    index="0" clip-path="url(#gridRectMaskwdaeu6lw)"
                                                                    pathTo="M 119.62857142857143 93.70079907417298L 119.62857142857143 37.900266358057664Q 119.62857142857143 32.900266358057664 124.62857142857143 32.900266358057664L 123.65714285714287 32.900266358057664Q 128.65714285714287 32.900266358057664 128.65714285714287 37.900266358057664L 128.65714285714287 37.900266358057664L 128.65714285714287 93.70079907417298Q 128.65714285714287 98.70079907417298 123.65714285714287 98.70079907417298L 124.62857142857143 98.70079907417298Q 119.62857142857143 98.70079907417298 119.62857142857143 93.70079907417298z"
                                                                    pathFrom="M 119.62857142857143 93.70079907417298L 119.62857142857143 93.70079907417298L 128.65714285714287 93.70079907417298L 128.65714285714287 93.70079907417298L 128.65714285714287 93.70079907417298L 128.65714285714287 93.70079907417298L 128.65714285714287 93.70079907417298L 119.62857142857143 93.70079907417298"
                                                                    cy="32.900266358057664" cx="142.20000000000002" j="5"
                                                                    val="80" barHeight="65.80053271611531"
                                                                    barWidth="9.028571428571428"></path>
                                                                <path id="SvgjsPath1767"
                                                                    d="M 142.20000000000002 93.70079907417298L 142.20000000000002 54.350399537086496Q 142.20000000000002 49.350399537086496 147.20000000000002 49.350399537086496L 146.22857142857146 49.350399537086496Q 151.22857142857146 49.350399537086496 151.22857142857146 54.350399537086496L 151.22857142857146 54.350399537086496L 151.22857142857146 93.70079907417298Q 151.22857142857146 98.70079907417298 146.22857142857146 98.70079907417298L 147.20000000000002 98.70079907417298Q 142.20000000000002 98.70079907417298 142.20000000000002 93.70079907417298z"
                                                                    fill="#71dd3729" fill-opacity="1" stroke-opacity="1"
                                                                    stroke-linecap="round" stroke-width="0"
                                                                    stroke-dasharray="0" class="apexcharts-bar-area"
                                                                    index="0" clip-path="url(#gridRectMaskwdaeu6lw)"
                                                                    pathTo="M 142.20000000000002 93.70079907417298L 142.20000000000002 54.350399537086496Q 142.20000000000002 49.350399537086496 147.20000000000002 49.350399537086496L 146.22857142857146 49.350399537086496Q 151.22857142857146 49.350399537086496 151.22857142857146 54.350399537086496L 151.22857142857146 54.350399537086496L 151.22857142857146 93.70079907417298Q 151.22857142857146 98.70079907417298 146.22857142857146 98.70079907417298L 147.20000000000002 98.70079907417298Q 142.20000000000002 98.70079907417298 142.20000000000002 93.70079907417298z"
                                                                    pathFrom="M 142.20000000000002 93.70079907417298L 142.20000000000002 93.70079907417298L 151.22857142857146 93.70079907417298L 151.22857142857146 93.70079907417298L 151.22857142857146 93.70079907417298L 151.22857142857146 93.70079907417298L 151.22857142857146 93.70079907417298L 142.20000000000002 93.70079907417298"
                                                                    cy="49.350399537086496" cx="164.7714285714286" j="6"
                                                                    val="60" barHeight="49.35039953708648"
                                                                    barWidth="9.028571428571428"></path>
                                                                <g id="SvgjsG1753" class="apexcharts-bar-goals-markers"
                                                                    style="pointer-events: none">
                                                                    <g id="SvgjsG1754"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG1756"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG1758"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG1760"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG1762"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG1764"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG1766"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG1752" class="apexcharts-datalabels"
                                                                data:realIndex="0"></g>
                                                        </g>
                                                        <line id="SvgjsLine1803" x1="0" y1="0"
                                                            x2="158" y2="0" stroke="#b6b6b6"
                                                            stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs"></line>
                                                        <line id="SvgjsLine1804" x1="0" y1="0"
                                                            x2="158" y2="0" stroke-dasharray="0"
                                                            stroke-width="0" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs-hidden"></line>
                                                        <g id="SvgjsG1805" class="apexcharts-yaxis-annotations"></g>
                                                        <g id="SvgjsG1806" class="apexcharts-xaxis-annotations"></g>
                                                        <g id="SvgjsG1807" class="apexcharts-point-annotations"></g>
                                                    </g>
                                                    <g id="SvgjsG1791" class="apexcharts-yaxis" rel="0"
                                                        transform="translate(-8, 0)">
                                                        <g id="SvgjsG1792" class="apexcharts-yaxis-texts-g"></g>
                                                    </g>
                                                    <g id="SvgjsG1741" class="apexcharts-annotations"></g>
                                                </svg>
                                                <div class="apexcharts-legend" style="max-height: 65px;"></div>
                                                <div class="apexcharts-tooltip apexcharts-theme-light">
                                                    <div class="apexcharts-tooltip-title"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    </div>
                                                    <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                            class="apexcharts-tooltip-marker"
                                                            style="background-color: rgba(113, 221, 55, 0.16);"></span>
                                                        <div class="apexcharts-tooltip-text"
                                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                            <div class="apexcharts-tooltip-y-group"><span
                                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                                            <div class="apexcharts-tooltip-goals-group"><span
                                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                                    class="apexcharts-tooltip-text-goals-value"></span>
                                                            </div>
                                                            <div class="apexcharts-tooltip-z-group"><span
                                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                    <div class="apexcharts-yaxistooltip-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="resize-triggers">
                                            <div class="expand-trigger">
                                                <div style="width: 209px; height: 202px;"></div>
                                            </div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100" style="max-width: 400px;">
                    <div class="card-body">
                        <h5 class="card-title">Project Name </h5>

                        <div class="my-2 text-muted d-flex justify-content-between">
                            <h6 class="card-subtitle text-muted">32.5K Visited </h6>
                            <h6 class="card-subtitle ">
                                <span class="p-2 text-primary"><i class='bx bxs-like'></i> 12.7K</span>
                                <span class="p-2 text-danger"><i class='bx bxs-dislike'></i> 1.2K</span>
                            </h6>
                        </div>

                    </div>
                    <img class="img-fluid" style="height: 200px"
                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/elements/13.jpg"
                        alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. A cupiditate
                            repudiandae incidunt itaque perferendis repellat, quo vitae nobis quibusdam laudantium
                            alias sint. Molestias, maxime commodi ea est corrupti minima nam..
                        </p>
                        <a href="javascript:void(0)" class="card-link">View Post</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Comments </h5>

                        <div class="mb-5 d-flex justify-content-start align-items-start customer-name">
                            <div class="avatar-wrapper">
                                <div class="avatar avatar-sm me-4"><img
                                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                        alt="Avatar" class="rounded-circle"></div>
                            </div>
                            <div class="d-flex flex-column">
                                <a
                                    href="#">
                                    <span class="fw-medium">Gisela Leppard</span>
                                </a>

                                <small class="text-wrap">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde
                                    ea doloremque, minima adipisci temporibus molestiae esse animi est dolorem quaerat
                                    consequuntur neque, incidunt exercitationem rerum veniam autem et explicabo corporis.
                                </small>


                                <div class="my-3 d-flex justify-content-start align-items-start customer-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-4"><img
                                                src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/6.png"
                                                alt="Avatar" class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a
                                            href="#">
                                            <span class="fw-medium">Gisela Leppard</span>
                                        </a>
                                        <small class="text-wrap">Great, I like it.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 d-flex justify-content-start align-items-start customer-name">
                            <div class="avatar-wrapper">
                                <div class="avatar avatar-sm me-4"><img
                                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/3.png"
                                        alt="Avatar" class="rounded-circle"></div>
                            </div>
                            <div class="d-flex flex-column">
                                <a
                                    href="#">
                                    <span class="fw-medium">John doe</span>
                                </a>

                                <small class="text-wrap">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde
                                    ea doloremque, minima adipisci temporibus molestiae esse animi est dolorem quaerat
                                    consequuntur neque, incidunt exercitationem rerum veniam autem et explicabo corporis.
                                </small>


                                <div class="my-3 d-flex justify-content-start align-items-start customer-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-4"><img
                                                src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/7.png"
                                                alt="Avatar" class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a
                                            href="#">
                                            <span class="fw-medium">Alice Nord</span>
                                        </a>
                                        <small class="text-wrap">Great, I like it.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
