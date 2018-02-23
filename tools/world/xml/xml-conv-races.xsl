<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="race">
    <xsl:copy>
      <xsl:apply-templates select="name|size|speed|ability|spellAbility|proficiency"/>
        <traits>
        <xsl:for-each select="trait">
            <xsl:value-of select="name" />
            <xsl:text> &#xa;</xsl:text>
            <xsl:value-of select="text" />
            <xsl:text>&#xa;&#xa;</xsl:text>
        </xsl:for-each>
      </traits>
    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
