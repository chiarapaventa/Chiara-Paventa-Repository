library(ggplot2)
library(readxl)
library(dplyr)

# Read in data from xlsx file
data <- read_excel("C:\\Users\\Chiara\\OneDrive - Università di Napoli Federico II\\Desktop\\Tesi\\Dati\\data\\others\\data_load_prod_weather.xlsx")

data$datetime <- as.Date(data$datetime)

columns <- colnames(data)[4:length(data)]
s1 <- "correlation_load_"
s2 <- "correlation_prduction_"
s3 <- ".pdf"

for(col in columns) {
  
    ggplot(carico, col) +
           geom_point() +
           geom_smooth(method = "lm", se = FALSE) +
           labs(x = "load", y = col, title = paste("Correlation between load and ", col))
  
    #correlation <- cor(data$carico, data$col) 
    #abline(lm(data$col ~ data$carico))
    
    #s <- paste(s1, data$col, s3)
    #ggsave(s, width = unit(7, "cm"), height = unit(7, "cm"))
    
}



