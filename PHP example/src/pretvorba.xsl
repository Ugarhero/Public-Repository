<?xml  version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="xml" indent="yes" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" />


    <xsl:template match="/">

        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="hr">

            <head>

                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">	</meta>
                <link rel="stylesheet" type="text/css" href="dizajn.css"> </link>
                <title>Popis</title>
            </head>

            <body>
                <div class="header">
                    <div class="picture-block">
                        <a href="http://www.unizg.hr/">
                            <img class="logo" src="./logo.png" alt="Logo"/>
                        </a>
                    </div>
                    <div class="title">
                        Fakulteti Sveučilišta u Zagrebu
                    </div>
                </div>
                <div class="container">
                    <div class="navigation-bar">
                        <ul class="no-bullets">
                            <li><a href="index.html">Početna stranica</a></li>
                            <li><a href="obrazac.html">Pretraživanje</a></li>
                            <li><a class="selected" href="podaci.xml">XML</a></li>
                            <li><a href="https://www.fer.unizg.hr/predmet/or">Otvoreno računarstvo</a></li>
                            <li><a target="_blank" href="https://www.fer.unizg.hr/">FER</a></li>
                            <li><a href="mailto:tomislav.dananic@fer.hr">Mail</a></li>
                        </ul>
                    </div>
                    <div class="content">

                        <table class="table-bordered">
                            <tr>
                                <th>Ime</th>
                                <th>Područje</th>
                                <th>Mjesto (poštanski broj)</th>
                                <th>Model</th>
                                <th>Kvota upisa</th>
                                <th>Sportovi</th>
                                <th>Parking</th>
                                <th>Kafići u blizini<br/>(udaljenosti do 2 km)</th>
                            </tr>

                            <xsl:for-each select="/fakulteti/fakultet">
                                <tr class="center-text bordered">
                                    <td>
                                       <xsl:variable name="link">
                                           <xsl:value-of select="fid"/>
                                       </xsl:variable>
                                        <a href="https://facebook.com/{$link}"><xsl:value-of select="ime"/></a>
                                    </td>
                                    <td>
                                        <xsl:value-of select="@podrucje"/>
                                    </td>
                                    <td>
                                        <xsl:value-of select="adresa/mjesto"/> (<xsl:value-of select="adresa/mjesto/@pbr"/>)
                                    </td>
                                    <td>
                                        <xsl:value-of select="studij/@model"/>
                                    </td>
                                    <td>
                                        <xsl:value-of select="studij/upis"/>
                                    </td>
                                    <td>
                                        <xsl:for-each select="sport/ekipa">
                                            <xsl:value-of select="."/><br/>
                                        </xsl:for-each>
                                    </td>
                                    <td>
                                        <xsl:for-each select="ostalo/parkiraliste">
                                            <xsl:value-of select="@vrsta"/>;
                                            <br/>
                                        </xsl:for-each>
                                    </td>
                                    <td>
                                        <xsl:for-each select="ostalo/kafic">
                                            <xsl:if test="@udaljenost &lt; 1000">
                                                <xsl:value-of select="." /> (<xsl:value-of select="@udaljenost"/> m);<br/>
                                            </xsl:if>
                                        </xsl:for-each>
                                    </td>
                                </tr>
                            </xsl:for-each>
                        </table>
                    </div>
                </div>
                <div class="footer center-text">
                    <p>Autor: <span class="credentials">Dananić Tomislav</span>
                    email: <span class="credentials">tomislav.dananic@fer.hr</span>
                    Sveučilište u Zagrebu, Fakultet elektrotehnike i računarstva
                    </p>
                </div>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>