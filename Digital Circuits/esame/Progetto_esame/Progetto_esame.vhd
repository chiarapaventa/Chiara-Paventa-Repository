----------------------------------------------------------------------------------
-- Company: 
-- Engineer: 
-- 
-- Create Date:    15:49:58 02/16/2018 
-- Design Name: 
-- Module Name:    progetto7 - Behavioral 
-- Project Name: 
-- Target Devices: 
-- Tool versions: 
-- Description: 
--
-- Dependencies: 
--
-- Revision: 
-- Revision 0.01 - File Created
-- Additional Comments: 
--
----------------------------------------------------------------------------------
library IEEE;
use IEEE.STD_LOGIC_1164.ALL;

entity Tensione_supplementare is
    Port ( v : in  STD_LOGIC;
           reset : in  STD_LOGIC;
			  clock : in  STD_LOGIC;
           aux : out  STD_LOGIC;		  
           low : out  STD_LOGIC;
           high : out  STD_LOGIC);
end Tensione_supplementare;

architecture Behavioral of Tensione_supplementare is
type stato is (s0,s1,s2,s3);                          -- dichiarazione stati
signal current_state,next_state: stato;               -- descrizione segnali
signal count_cycles : integer range 0 to 10;

begin

  -- Process 1: definisce quando la macchina cambia stato
  processo_reset_asincrono:process(clock,reset)       
    begin                                                  
	 if(reset='1') then
		   current_state<=S0;
			 elsif rising_edge(clock) then
			   current_state<=next_state;
		    end if;    
   end process;
	
	-- Process 2: conta i cicli di clock, necessari al passaggio di stato
  contatore_cicli_di_clock:process(clock,reset)        
    begin                                               
	   if(reset='1') then 
		  count_cycles<=0;
		 elsif rising_edge(clock) then 
          if(count_cycles=10) then
              count_cycles<=0;
            elsif (count_cycles/=10) then
                 count_cycles<=count_cycles+1;
          end if;
       end if;
   end process;
	
	-- Process 3: Descrive per ogni stato quale sarà il next state in base agli ingressi
  transizione_stati:process(current_state,v,count_cycles)       
    begin                                                    
      case(current_state) is
           when s0 =>
               if v='1' then
                 next_state<=current_state;
               else
                 next_state<=s1;
               end if;
           when s1=>
               if v='1' then
                 next_state<=s0;
                 elsif v='0' then
					    if count_cycles=5 then
                      next_state<=s2;
				       else
					       next_state<=s1;
				       end if;
					 end if;
           when s2=>
               if v='1' then
                 next_state<=s0;
                 elsif v='0' then
					    if count_cycles=10 then
                      next_state<=s3;
				       else
					       next_state<=s2;
				       end if;
					 end if;
           when s3=>
               next_state<=s0;
 
       end case;
   end process;
	
 -- Process 3: Indica per ogni stato,quali sono le uscite
 funzione_uscita:process(current_state)                            
 begin                                                            
 case(current_state) is
  when s0=>
    aux<='0'; low<='0'; high<='0';
  when s1=>
    aux<='1';low<='0'; high<='0';
  when s2=>
    aux<='1';low<='1'; high<='0';
  when s3=>
    aux<='0';low<='0'; high<='1';
 end case;
end process;

end Behavioral;


