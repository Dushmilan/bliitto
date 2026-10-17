@extends('layouts.app')

@section('content')

    <main class="page-transition" style="padding: 120px 0 60px 0; min-height: 80vh;">
        <!-- Header Section -->
        <section class="section text-center">
            <div class="container">
                <h1 class="scroll-reveal" style="font-size: 3rem; color: var(--primary-color);">Patent <span class="highlight">Searches</span></h1>
                <p class="scroll-reveal delay-1" style="font-size: 1.1rem; max-width: 700px; margin: 1rem auto; color: var(--text-light);">
                    Access to open-source and commercial patent databases.
                </p>
            </div>
        </section>

        <!-- Patent Searches Section -->
        <section id="patent-searches" class="section bg-light">
            <div class="container">
                <!-- Opensource Databases -->
                <h3 class="scroll-reveal" style="color: var(--primary-color); margin-bottom: 1.5rem;">Commonly Used Open-Source Patent Databases</h3>
                
                <div class="grid-2-col scroll-reveal delay-1" style="margin-bottom: 4rem;">
                    <!-- Patentscope -->
                    <div class="card" style="padding: 2rem; border-top: 4px solid var(--secondary-color); display: flex; flex-direction: column;">
                        <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">WIPO Patentscope</h4>
                        <p style="color: var(--text-main); font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.6; flex-grow: 1;">
                            This patent search tool allows you not only to search the PCT database of about 2 million International Applications but also the worldwide patent collections.
                        </p>
                        <a href="https://patentscope.wipo.int/search/en/search.jsf" target="_blank" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem; align-self: flex-start;">Search Database</a>
                    </div>
                    
                    <!-- USPTO -->
                    <div class="card" style="padding: 2rem; border-top: 4px solid var(--secondary-color); display: flex; flex-direction: column;">
                        <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">USPTO Patent Full-Text</h4>
                        <p style="color: var(--text-main); font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.6; flex-grow: 1;">
                            US Patents may be searched in the USPTO Patent Full-Text and Image Database (PatFT). The USPTO houses full text for patents issued from 1976 to the present and PDF images for all patents from 1790 to the present.
                        </p>
                        <a href="http://patft.uspto.gov/netahtml/PTO/srchnum.htm" target="_blank" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem; align-self: flex-start;">Search Database</a>
                    </div>
                    
                    <!-- Espacenet -->
                    <div class="card" style="padding: 2rem; border-top: 4px solid var(--secondary-color); display: flex; flex-direction: column;">
                        <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">EPO Espacenet</h4>
                        <p style="color: var(--text-main); font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.6; flex-grow: 1;">
                            Espacenet is an EPO database containing over 110 million patent documents from over 100 countries. It offers free access to information about inventions and technical developments from 1782 to today.
                        </p>
                        <a href="https://worldwide.espacenet.com/patent/" target="_blank" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem; align-self: flex-start;">Search Database</a>
                    </div>
                    
                    <!-- FDA Orange Book -->
                    <div class="card" style="padding: 2rem; border-top: 4px solid var(--secondary-color); display: flex; flex-direction: column;">
                        <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">FDA Electronic Orange Book</h4>
                        <p style="color: var(--text-main); font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.6; flex-grow: 1;">
                            For generics and trade name searching of actives approved by the Food and Drug Administration in the United States. Patent numbers can be found here.
                        </p>
                        <a href="http://www.fda.gov/cder/ob/default.htm" target="_blank" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem; align-self: flex-start;">Search Database</a>
                    </div>
                </div>

                <!-- Commercial Databases -->
                <h3 class="scroll-reveal" style="color: var(--primary-color); margin-bottom: 1rem;">Commercial Patent & Non-Patent Databases</h3>
                
                <div class="alert-box scroll-reveal delay-1" style="background-color: #fff3cd; border-left: 5px solid #ffc107; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
                    <p style="margin: 0; color: #856404; font-weight: 500; line-height: 1.6;">
                        <strong style="font-size: 1.1rem; display: block; margin-bottom: 0.5rem;">🔒 Access Notice</strong>
                        The following commercial databases can only be accessed at the Business Linkage, Innovation, Incubation and Technology Transfer Office of the University of Peradeniya. In order to access these databases, please contact the Technology Manager, BLII-TTO. Please note that these databases have limited access and are available only a few days per month.
                    </p>
                </div>
                
                <div class="database-links scroll-reveal delay-2">
                    <a href="https://www.j-platpat.inpit.go.jp/" target="_blank" class="db-link">Japan</a>
                    <a href="http://eng.kipris.or.kr/enghome/main.jsp" target="_blank" class="db-link">Korea</a>
                    <a href="http://pericles.ipaustralia.gov.au/ols/auspat/quickSearch.do" target="_blank" class="db-link">Australia</a>
                    <a href="http://www.ers.usda.gov/Data/AgBiotechIP/" target="_blank" class="db-link">Biotechnological US</a>
                    <a href="http://brevets-patents.ic.gc.ca/opic-cipo/cpd/eng/introduction.html" target="_blank" class="db-link">Canada</a>
                    <a href="http://www.european-coatings.com/" target="_blank" class="db-link">European Coating</a>
                    <a href="http://www.iponz.govt.nz/cms/patents/banner_template/IPPATENT" target="_blank" class="db-link">New Zealand</a>
                    <a href="http://www.ipo.gov.uk/patent.htm/" target="_blank" class="db-link">UK</a>
                    <a href="http://depatisnet.dpma.de/" target="_blank" class="db-link">Germany</a>
                    <a href="http://lp.espacenet.com/" target="_blank" class="db-link">Latipat (Latin America)</a>
                    <a href="http://english.sipo.gov.cn" target="_blank" class="db-link">China</a>
                    <a href="http://www.eapatis.com/ensearch/" target="_blank" class="db-link">Eurasia</a>
                    <a href="http://www.egypo.gov.eg/Search/default.aspx" target="_blank" class="db-link">Egypt</a>
                    <a href="http://worldwide.espacenet.com/advancedSearch?locale=en_EP" target="_blank" class="db-link">Africa (ARIPO/OAPI)</a>
                    <a href="http://www.freepatentsonline.com/search.html" target="_blank" class="db-link">Freepatentsonline</a>
                    <a href="http://www.oepm.es/en/index.html" target="_blank" class="db-link">Spain</a>
                    <a href="http://ipindiaservices.gov.in/publicsearch" target="_blank" class="db-link">India</a>
                    <a href="http://www.ipos.gov.sg/Services/FilingandRegistration/GettingStartedwitheServices/eSearch.aspx" target="_blank" class="db-link">Singapore</a>
                    <a href="http://www.dgip.go.id/" target="_blank" class="db-link">Indonesia</a>
                    <a href="http://ipsearch.ipd.gov.hk/patent/main.jsp?LANG=en" target="_blank" class="db-link">Hong Kong</a>
                    <a href="http://www.ukrpatent.org/en/index.html" target="_blank" class="db-link">Ukraine</a>
                    <a href="http://www.osim.ro/index3_files/database/datab.htm" target="_blank" class="db-link">Romania</a>
                    <a href="https://www.lens.org/lens/" target="_blank" class="db-link">Cambia</a>
                </div>
            </div>
        </section>
    </main>

@endsection
