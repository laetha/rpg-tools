<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="monster">
    <xsl:copy>
      <xsl:apply-templates select="name|size|type|alignment|ac|hp|speed|str|dex|con|intel|wis|cha|save|skill|resist|vulnerable|immune|conditionImmune|senses|passive|languages|cr|reaction"/>
        <xsl:for-each select="trait">
          <xsl:variable name="pos" select="position()"/>
          <xsl:element name="trait{$pos}">
            <xsl:value-of select="name" />
            <xsl:text> &#xa;</xsl:text>
            <xsl:for-each select="text">
                <xsl:value-of select="."/>
                <xsl:if test="position() != last()">
                   <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                   <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                   <xsl:text> &#xa;&#xa;</xsl:text>
                </xsl:if>
            </xsl:for-each>
          </xsl:element>
        </xsl:for-each>
        <xsl:for-each select="action">
          <xsl:variable name="pos" select="position()"/>
        <xsl:element name="action{$pos}">
          <xsl:value-of select="name" />
          <xsl:text> &#xa;</xsl:text>
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="legendary">
        <xsl:variable name="pos" select="position()"/>
      <xsl:element name="legendary{$pos}">
        <xsl:value-of select="name" />
        <xsl:text> &#xa;</xsl:text>
        <xsl:for-each select="text">
            <xsl:value-of select="."/>

        </xsl:for-each>
      </xsl:element>
    </xsl:for-each>

    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
