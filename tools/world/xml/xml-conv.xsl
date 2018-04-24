<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="item">
    <xsl:copy>
      <xsl:apply-templates select="title|type|itemType|itemMagic|itemDetail"/>
      <text>
        <xsl:for-each select="text">
            <xsl:value-of select="."/>
            <xsl:if test="position() != last()">
               <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
               <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
               <xsl:text> &#xa;&#xa;</xsl:text>
            </xsl:if>
            <xsl:if test="position() = last()">
              <xsl:text>Source: Unofficial</xsl:text>
              </xsl:if>
        </xsl:for-each>
      </text>
    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
