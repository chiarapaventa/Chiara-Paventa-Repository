--------------------------------------------------------------------------------
-- Company: 
-- Engineer:
--
-- Create Date:   11:40:08 12/07/2017
-- Design Name:   
-- Module Name:   C:/Users/Chiara/Desktop/Progetti/Majority/tb_Majority2.vhd
-- Project Name:  Majority
-- Target Device:  
-- Tool versions:  
-- Description:   
-- 
-- VHDL Test Bench Created by ISE for module: Majority
-- 
-- Dependencies:
-- 
-- Revision:
-- Revision 0.01 - File Created
-- Additional Comments:
--
-- Notes: 
-- This testbench has been automatically generated using types std_logic and
-- std_logic_vector for the ports of the unit under test.  Xilinx recommends
-- that these types always be used for the top-level I/O of a design in order
-- to guarantee that the testbench will bind correctly to the post-implementation 
-- simulation model.
--------------------------------------------------------------------------------
LIBRARY ieee;
USE ieee.std_logic_1164.ALL;
 
-- Uncomment the following library declaration if using
-- arithmetic functions with Signed or Unsigned values
--USE ieee.numeric_std.ALL;
 
ENTITY tb_Majority2 IS
END tb_Majority2;
 
ARCHITECTURE behavior OF tb_Majority2 IS 
 
    -- Component Declaration for the Unit Under Test (UUT)
 
    COMPONENT Majority
    PORT(
         a : IN  std_logic;
         b : IN  std_logic;
         c : IN  std_logic;
         x : OUT  std_logic
        );
    END COMPONENT;
    

   --Inputs
   signal a : std_logic := '0';
   signal b : std_logic := '0';
   signal c : std_logic := '0';

 	--Outputs
   signal x : std_logic;
   -- No clocks detected in port list. Replace <clock> below with 
   -- appropriate port name 
 
   --constant <clock>_period : time := 10 ns;
 
BEGIN
 
	-- Instantiate the Unit Under Test (UUT)
   uut: Majority PORT MAP (
          a => a,
          b => b,
          c => c,
          x => x
        );

--   -- Clock process definitions
--   --<clock>_process :process
--   begin
--		<clock> <= '0';
--		wait for <clock>_period/2;
--		<clock> <= '1';
--		wait for <clock>_period/2;
--   end process;
 

   -- Stimulus process
   stim_proc: process
	variable err_process : integer : =0;
   begin		
--      -- hold reset state for 100 ns.
--      wait for 100 ns;	
--
--      wait for <clock>_period*10;

      -- insert stimulus here 
-- case 0
a <= '0';
b <= '0';
c <= '0';
wait for 10 ns;
assert (x='0') report "Error!" severity error;
if (x/='0') then 
err_cnt=err_cnt+;
end if;

-- case 1
a <= '0';
b <= '0';
c <= '1';
wait for 10 ns;
assert (x='0') report "Error!" severity error;
if (x/='0') then 
err_cnt=err_cnt+;
end if;

-- case 2
a <= '0';
b <= '1';
c <= '0';
wait for 10 ns;
assert (x='0') report "Error!" severity error;
if (x/='0') then 
err_cnt=err_cnt+;
end if;


-- case 3
a <= '0';
b <= '1';
c <= '1';
wait for 10 ns;
assert (x='1') report "Error!" severity error;
if (x/='1') then 
err_cnt=err_cnt+;
end if;

-- case 4
a <= '1';
b <= '0';
c <= '0';
wait for 10 ns;
assert (x='0') report "Error!" severity error;
if (x/='0') then 
err_cnt=err_cnt+;
end if;


-- case 5
a <= '1';
b <= '0';
c <= '1';
wait for 10 ns;
assert (x='1') report "Error!" severity error;
if (x/='1') then 
err_cnt=err_cnt+;
end if;

-- case 6
a <= '1';
b <= '1';
c <= '0';
wait for 10 ns;
assert (x='1') report "Error!" severity error;
if (x/='1') then 
err_cnt=err_cnt+;
end if;

-- case 7
a <= '1';
b <= '1';
c <= '1';
wait for 10 ns;
assert (x='1') report "Error!" severity error;
if (x/='1') then 
err_cnt=err_cnt+;
end if;

   end process;

END;
